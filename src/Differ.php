<?php

namespace Differ\Differ;

use function Differ\Parsers\parse;
use function Differ\InnerDiff\genInnerDiff;
use function Differ\Formatters\format;

function genDiff($path1, $path2, $format = 'stylish')
{
    $data1 = parse($path1);
    $data2 = parse($path2);
    $diff = genInnerDiff($data1, $data2);
    $result = format($diff, $format);
    return $result;
}
