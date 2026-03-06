<?php

namespace App\Services\ApiNormalizer\Adapters;

final class PathExtractor
{

    public function __construct()
    {
    }

    public function extractItems($rawResponse, $root = ''): array
    {
        if (!empty($root) && isset($rawResponse[$root])) {
            $rawResponse = $rawResponse[$root];
        }

        // Se já for uma lista de itens
        if (is_array($rawResponse) && !$this->isAssoc($rawResponse)) {
            $result = [];

            foreach ($rawResponse as $item) {
                $result[] = $this->flattenArray($item);
            }

            return $result;
        }

        // Se for um único item associativo
        return $this->flattenArray($rawResponse);
    }

    private function flattenArray($data, $prefix = ''): array
    {
        $result = [];

        if (!is_array($data)) {
            if ($prefix !== '') {
                $result[$prefix] = $data;
            }
            return $result;
        }

        foreach ($data as $key => $value) {
            // Se a chave for numérica, usa índice humano (1,2,3...)
            $currentKey = is_numeric($key) ? ((int) $key + 1) : $key;

            $newPrefix = $prefix === ''
                ? $currentKey
                : $prefix . '_' . $currentKey;

            if (is_array($value)) {
                $result = array_merge($result, $this->flattenArray($value, $newPrefix));
            } else {
                $result[$newPrefix] = $value;
            }
        }

        return $result;
    }

    private function isAssoc(array $array): bool
    {
        if ($array === []) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }
}
