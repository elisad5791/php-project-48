<?php

namespace Differ\Formatters\StylishFormatter;

function getPad($depth)
{
    $count = 4 * ($depth - 1);
    $padSmall = str_repeat(' ', $count);
    $pad = str_repeat(' ', $count + 2);
    return [$padSmall, $pad];
}

function prepare($value, $depth)
{
    [$padSmall, $pad] = getPad($depth);
    if ($value === true) {
        return ' true';
    }
    if ($value === false) {
        return ' false';
    }
    if ($value === null) {
        return ' null';
    }
    if (!is_array($value)) {
        return empty($value) ? '' : " $value";
    }

    $keys = array_keys($value);
    $result = array_map(function ($key) use ($value, $pad, $padSmall, $depth) {
        $val = prepare($value[$key], $depth + 1);
        return "$pad  $key:$val";
    }, $keys);
    $innerPart = implode("\n", $result);
    return " {\n$innerPart\n$padSmall}";
}

function iter($diff, $depth)
{
    $keys = array_keys($diff);
    [$padSmall, $pad] = getPad($depth);

    $result = array_map(function ($key) use ($diff, $pad, $padSmall, $depth) {
        extract($diff[$key]);

        if ($status === 'removed') {
            $val = prepare($values['value'], $depth + 1);
            $str = "$pad- $key:$val";
        }

        if ($status === 'added') {
            $val = prepare($values['value'], $depth + 1);
            $str = "$pad+ $key:$val";
        }

        if ($status === 'unchanged') {
            $val = prepare($values['value'], $depth + 1);
            $str = "$pad  $key:$val";
        }

        if ($status === 'updated') {
            if (array_key_exists('diff', $values)) {
                $val = iter($values['diff'], $depth + 1);
                $str = "$pad  $key: $val";
            } else {
                $oldVal = prepare($values['oldValue'], $depth + 1);
                $newVal = prepare($values['newValue'], $depth + 1);
                $str = "$pad- $key:$oldVal\n$pad+ $key:$newVal";
            }
        }

        return $str;
    }, $keys);

    $innerPart = implode("\n", $result);
    return "{\n$innerPart\n$padSmall}";
}

function stylishFormat($diff)
{
    return iter($diff, 1);
}
