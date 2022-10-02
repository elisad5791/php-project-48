<?php

namespace Differ\Formatters\PlainFormatter;

function normalize($value)
{
    if (is_array($value)) {
        return '[complex value]';
    }
    if (is_string($value)) {
        return "'$value'";
    }
    if ($value === true) {
        return 'true';
    }
    if ($value === false) {
        return 'false';
    }
    if ($value === null) {
        return 'null';
    }
    return $value;
}

function iter($diff, $path)
{
    $keys = array_keys($diff);

    $result = array_map(function ($key) use ($diff, $path) {
        extract($diff[$key]);
        $str = '';
        $newPath = [...$path, $key];
        $fullKey = implode('.', $newPath);

        if ($status === 'removed') {
            $str = "Property '$fullKey' was removed";
        }

        if ($status === 'added') {
            $value = $values['value'];
            $val = normalize($value);
            $str = "Property '$fullKey' was added with value: $val";
        }

        if ($status === 'updated') {
            if (array_key_exists('diff', $values)) {
                $str = iter($values['diff'], $newPath);
            } else {
                $oldVal = normalize($values['oldValue']);
                $newVal = normalize($values['newValue']);
                $str = "Property '$fullKey' was updated. From $oldVal to $newVal";
            }
        }

        return $str;
    }, $keys);

    $filteredResult = array_filter($result, fn($str) => !empty($str));
    return implode("\n", $filteredResult);
}

function plainFormat($diff)
{
    return iter($diff, []);
}