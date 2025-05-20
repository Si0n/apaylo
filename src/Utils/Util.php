<?php

namespace ApiIntegrations\Apaylo\Utils;

class Util
{
    public static function arrayValue(string $key, array $array, mixed $default = null): mixed
    {
        $path = explode('.', $key);
        $value = $array;
        foreach ($path as $segment) {
            if (!array_key_exists($segment, $value)) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }
}