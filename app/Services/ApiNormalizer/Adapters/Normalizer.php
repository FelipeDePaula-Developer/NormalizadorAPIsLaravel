<?php
namespace App\Infrastructure\Normalization;

final class Normalizer
{
    public function normalizeItems(array $rawResponse, array $endpointContract, array $canonicalSchema): array
    {
        $itemsPath = $endpointContract['response']['items_path'] ?? null;
        if (!$itemsPath) {
            throw new \RuntimeException("Contract sem response.items_path");
        }

        $extractor = new PathExtractor();
        $rawItems = $extractor->extractItems($rawResponse, $itemsPath);
        $mappingFields = $endpointContract['mapping']['fields'] ?? [];
        if (!is_array($mappingFields)) $mappingFields = [];

        $schemaFields = $canonicalSchema['mapping']['fields'] ?? [];
        if (!is_array($schemaFields)) $schemaFields = [];
        $out = [];
        $entity = [];
        foreach ($rawItems as $rawItem) {
            if (!is_array($rawItem)) continue;

            // 1) Monta entidade canônica via mapping

            foreach ($mappingFields as $canonicalField => $spec) {
                if (!is_array($spec)) continue;
                if (empty($spec['field'])) continue;

                $value = $rawItem[$canonicalField] ?? null;
                // cast inicial conforme source_type
                $sourceType = $spec['type'] ?? null;
                $value = $this->castByType($value, $sourceType, $spec);
                $canonicalType = $schemaFields[$spec['field']]['type'] ?? null;
                $canonicalFmt  = $schemaFields[$spec['field']]['format'] ?? null;
                $value = $this->castToCanonical($value, $canonicalType, $canonicalFmt);
                $entity[$spec['field']] = $value;
            }
            // 2) aplica defaults + valida required do schema
            $entity = $this->applyDefaultsAndValidate($entity, $schemaFields);
            $out[] = $entity;
        }
        return $out;
    }

    private function castByType($value, ?string $type, array $spec)
    {
        switch ($type) {
            case 'int':
                return Cast::toInt($value);

            case 'string':
                return Cast::toString($value);

            case 'decimal':
                return Cast::toDecimal(
                    $value,
                    $spec['decimal_separator'] ?? '.',
                    $spec['thousands_separator'] ?? ''
                );

            case 'date':
                return Cast::toDate($value, $spec['format'] ?? 'Y-m-d', 'Y-m-d');

            default:
                return $value;
        }
    }

    private function castToCanonical($value, ?string $type, ?string $format)
    {
        switch ($type) {
            case 'int':
                return Cast::toInt($value);

            case 'string':
                return Cast::toString($value);

            case 'decimal':
                return Cast::toDecimal($value, '.', '');

            case 'date':
                $fmt = $format ?? 'Y-m-d';
                return Cast::toDate($value, $fmt, $fmt);

            default:
                return $value;
        }
    }


    private function applyDefaultsAndValidate(array $entity, array $schemaFields): array
    {
        foreach ($schemaFields as $field => $cfg) {
            $required = (bool)($cfg['required'] ?? false);
            $hasValue = array_key_exists($field, $entity) && $entity[$field] !== null && $entity[$field] !== '';

            if (!$hasValue && array_key_exists('default', $cfg)) {
                $entity[$field] = $cfg['default'];
                $hasValue = true;
            }

            if ($required && !$hasValue) {
                throw new \RuntimeException("Campo canônico obrigatório ausente: {$field}");
            }
        }

        // opcional: remover campos não definidos no schema
        $entity = array_intersect_key($entity, $schemaFields);

        return $entity;
    }
}
