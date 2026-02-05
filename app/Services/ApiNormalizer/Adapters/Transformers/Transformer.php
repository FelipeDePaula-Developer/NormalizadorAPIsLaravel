<?php
namespace App\Infrastructure\Normalization;

final class Transformer
{
    public static function apply($value, array $transformSpec)
    {
        // transformSpec: lista de steps
        foreach ($transformSpec as $step) {
            if (!is_array($step)) continue;

            if (isset($step['date'])) {
                $cfg = $step['date'] ?? [];
                $in  = $cfg['input_format'] ?? 'Y-m-d';
                $out = $cfg['output_format'] ?? 'Y-m-d';
                $value = Cast::toDate($value, $in, $out);
                continue;
            }

            if (isset($step['decimal'])) {
                $cfg = $step['decimal'] ?? [];
                $dec = $cfg['decimal_separator'] ?? '.';
                $tho = $cfg['thousands_separator'] ?? '';
                $value = Cast::toDecimal($value, $dec, $tho);
                continue;
            }

            if (isset($step['trim'])) {
                $value = is_string($value) ? trim($value) : $value;
                continue;
            }
        }

        return $value;
    }
}
