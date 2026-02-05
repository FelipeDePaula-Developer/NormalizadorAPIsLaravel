<?php

namespace Adapters;
use Symfony\Component\Yaml\Yaml;

final class YamlContractLoader
{
    public function load(string $filePath): array
    {
        if (!is_file($filePath)) {
            throw new \RuntimeException("YAML não encontrado: {$filePath}");
        }

        $content = file_get_contents($filePath);

        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = mb_convert_encoding($content, 'UTF-8', 'auto');
        }

        $data = Yaml::parse($content);

        if (!is_array($data)) {
            throw new \RuntimeException("YAML inválido: {$filePath}");
        }
        return $data;
    }
}
