<?php
namespace App\Infrastructure\Normalization;

final class PathExtractor
{
    /**
     * Agora suporta:
     * 1) Legado: string "data data[defaulterInstallments]"
     * 2) Novo: [
     *      'principalPath'  => 'data[defaulterInstallments]',
     *      'complementPath' => ['data', 'data[foo]', ...]
     *    ]
     *
     * @param array|string $itemsPath
     * @return array<int, mixed>
     */
    public function extractItems(array $root, array|string $itemsPath): array
    {
        // ----------------------------
        // Normaliza input (legado x novo)
        // ----------------------------
        if (is_string($itemsPath)) {
            $paths = preg_split('/\s+/', trim($itemsPath));
            $baseListPath    = $paths[0] ?? '';
            $principalPath   = $paths[1] ?? '';
            $complementPaths = [$baseListPath]; // no legado, o complement é o próprio base
        } else {
            $principalPath   = (string)($itemsPath['principalPath'] ?? '');
            $complementPaths = $itemsPath['complementPath'] ?? [];

            if (!is_array($complementPaths)) {
                $complementPaths = [$complementPaths];
            }

            $baseListPath = (string)($complementPaths[0] ?? '');
        }

        $baseListPath  = trim($baseListPath);
        $principalPath = trim($principalPath);

        if ($baseListPath === '') return [];

        // ----------------------------
        // 1) Pega lista base (ex.: data)
        // ----------------------------
        $bases = $this->getByPath($root, $baseListPath);
        if (!is_array($bases)) return [];
        if ($this->isAssoc($bases)) $bases = [$bases];

        // ----------------------------
        // 2) Faz o principal virar relativo ao baseListPath
        //    ex.: principal "data[defaulterInstallments]" relativo a "data" => "defaulterInstallments"
        // ----------------------------
        $principalRelative = $this->normalizeBracketPath(
            $this->stripBasePrefix($principalPath, $baseListPath)
        );

        $principalKey = $this->lastToken($principalRelative); // para unset no baseFlat

        // ----------------------------
        // 3) Para cada item base, monta baseFlat (merge de complementPaths) e multiplica pelo principal
        // ----------------------------
        $out = [];

        foreach ($bases as $base) {
            if (!is_array($base)) continue;

            // 3.1) Monta o "baseFlat" a partir de complementPaths (pode ter N caminhos)
            $baseFlat = [];

            foreach ($complementPaths as $cp) {
                $cp = trim((string)$cp);
                if ($cp === '') continue;

                // deixa relativo ao baseListPath
                $rel = $this->normalizeBracketPath(
                    $this->stripBasePrefix($cp, $baseListPath)
                );

                $val = ($rel === '') ? $base : $this->getByPath($base, $rel);

                // Só mergeia se for assoc (um "objeto"). Se for lista, ignora.
                if (is_array($val) && $this->isAssoc($val)) {
                    $baseFlat = array_merge($baseFlat, $val);
                }
            }

            // fallback: se não veio nada nos complementPaths, usa o base inteiro
            if ($baseFlat === []) {
                $baseFlat = $base;
            }

            // remove do baseFlat o array principal (ex.: defaulterInstallments) pra não carregar dentro do flat
            if ($principalKey !== '' && array_key_exists($principalKey, $baseFlat)) {
                unset($baseFlat[$principalKey]);
            }

            // você pode remover outros arrays aqui, se quiser:
            unset($baseFlat['defaulterJudicialActivities']);

            // 3.2) Pega os itens do principal (lista que multiplica)
            $items = ($principalRelative !== '')
                ? $this->getByPath($base, $principalRelative)
                : [];

            if (!is_array($items)) $items = [];
            if ($this->isAssoc($items)) $items = [$items];

            // 3.3) Multiplica: 1 linha por item do principal
            if (count($items) === 0) {
                $out[] = $baseFlat;
                continue;
            }

            foreach ($items as $it) {
                if (!is_array($it)) continue;
                $out[] = array_merge($baseFlat, $it);
            }
        }

        return array_values($out);
    }

    /** Caminho tipo: "data", "a[b][c]" ou "a.b.c" */
    private function getByPath(array $root, string $path)
    {
        $path = trim($path);
        if ($path === '') return $root;

        $tokens = $this->tokenizePath($path);

        $cur = $root;
        foreach ($tokens as $t) {
            if (!is_array($cur) || !array_key_exists($t, $cur)) {
                return null;
            }
            $cur = $cur[$t];
        }
        return $cur;
    }

    private function tokenizePath(string $path): array
    {
        $path = $this->normalizeBracketPath($path);
        preg_match_all('/([^\[\]]+)/', $path, $m);
        return $m[1] ?? [];
    }

    private function normalizeBracketPath(string $path): string
    {
        $path = trim($path);
        if ($path === '') return '';

        // aceita "a.b.c"
        $path = str_replace('.', '[', $path);

        // fecha colchetes se abriu mais do que fechou
        $opens = substr_count($path, '[');
        $closes = substr_count($path, ']');
        if ($opens > $closes) {
            $path .= str_repeat(']', $opens - $closes);
        }

        return $path;
    }

    private function stripBasePrefix(string $childPath, string $basePath): string
    {
        $childPath = trim($childPath);
        $basePath  = trim($basePath);

        if ($childPath === '') return '';
        if ($basePath === '') return $childPath;

        // "data[defaulterInstallments]" relativo a "data" => "defaulterInstallments"
        if (str_starts_with($childPath, $basePath . '[') && str_ends_with($childPath, ']')) {
            return substr($childPath, strlen($basePath) + 1, -1);
        }

        if ($childPath === $basePath) return '';

        return $childPath;
    }

    private function lastToken(string $path): string
    {
        $path = trim($path);
        if ($path === '') return '';

        $tokens = $this->tokenizePath($path);
        if (!$tokens) return '';
        return (string)end($tokens);
    }

    private function isAssoc(array $arr): bool
    {
        $keys = array_keys($arr);
        return $keys !== range(0, count($arr) - 1);
    }
}
