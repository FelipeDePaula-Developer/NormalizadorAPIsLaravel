<?php

namespace App\Services\ApiNormalizer\Adapters\Loader;

use Illuminate\Database\Eloquent\Casts\Json;

final class JsonContractLoader
{
    public function load(string $filePath): array
    {
        if (!is_file($filePath)) {
            throw new \RuntimeException("JSON não encontrado: {$filePath}");
        }

        $content = file_get_contents($filePath);

        $data = Json::decode($content, true);
        if (!is_array($data)) {
            throw new \RuntimeException("Json inválido: {$filePath}");
        }
        return $data;
    }
}
