<?php

namespace App\Services\ApiNormalizer\Adapters;

final class PathExtractor
{

    public function __construct()
    {
    }

    public function extractItems($rawResponse, $itemsPath, $root)
    {
        $principalPath = $itemsPath['principalPath'];
        $complementPaths = $itemsPath['complementPath'];

        if ($principalPath[0] != $root)
            $rawResponse = $rawResponse[$root];

        $baseBody = [];
        foreach ($rawResponse as $item) {
            $baseBody = $this->getItemByPath($item, $principalPath);

            if ($complementPaths !== []) {
                $baseBody = array_merge($baseBody, $this->getItemByPath($item, $complementPaths, true));
            }
        }
    }

    public function getItemByPath($item, $paths, $debug_complement = false, $nextPath = 0)
    {
        if ($debug_complement)
            dump(func_get_args());


        $out = [];
        foreach ($paths as $path) {
            if ($debug_complement)
                dump($path);

            if (is_array($path)) {
                $total_path = count($path);
                $temp_item = $item;
                foreach ($path as $key => $subPath) {
                    $next_path = false;
                    foreach ($temp_item as $field => $value) {
                        dump($temp_item);
                        dump([$field => $subPath]);
                        if ($subPath === '$n') {
                            $temp_item = $this->getItemByPath($value, [$path[$key + 1]], true, 1);
                            dd($temp_item);
                            $next_path = true;
                            break;
                        }

                        if ($field == $subPath) {
                            if ($key < $total_path - 1) {
                                $temp_item = $value;
                                $next_path = true;
                                break;
                            }else{
                                $out = $temp_item;
                            }
                        }
                    }

                    if ($next_path)
                        continue;
                }
                dd($out);
            } else {
                foreach ($item as $field => $value) {
                    if ($field == $path) {
                        $out = $value;
                    }
                }
            }
        }

        return $out;
    }
}
