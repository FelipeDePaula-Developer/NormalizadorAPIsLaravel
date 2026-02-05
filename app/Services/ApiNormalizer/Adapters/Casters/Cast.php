<?php
namespace App\Services\ApiNormalizer\Adapters\Casters;

final class Cast
{
    public static function toInt($v): ?int
    {
        if ($v === null || $v === '') return null;
        if (is_int($v)) return $v;
        if (is_numeric($v)) return (int)$v;
        return null;
    }

    public static function toString($v): ?string
    {
        if ($v === null) return null;
        if (is_string($v)) return $v;
        return (string)$v;
    }

    public static function toDecimal($v, string $decimalSep='.', string $thousandsSep=''): ?string
    {
        if ($v === null || $v === '') return null;

        if (is_int($v) || is_float($v)) {
            // normaliza em string (sem formatar demais)
            return rtrim(rtrim(number_format((float)$v, 2, '.', ''), '0'), '.');
        }

        $s = (string)$v;
        if ($thousandsSep !== '') $s = str_replace($thousandsSep, '', $s);
        if ($decimalSep !== '.') $s = str_replace($decimalSep, '.', $s);

        // valida número simples
        if (!preg_match('/^-?\d+(\.\d+)?$/', $s)) return null;
        return $s;
    }

    public static function toDate($v, string $inputFormat, string $outputFormat='Y-m-d'): ?string
    {
        if ($v === null || $v === '') return null;
        $s = (string)$v;

        $dt = \DateTime::createFromFormat($inputFormat, $s);
        if (!$dt) {
            // fallback ISO (bem comum em APIs)
            $dt2 = date_create($s);
            if (!$dt2) return null;
            return $dt2->format($outputFormat);
        }
        return $dt->format($outputFormat);
    }
}
