<?php

namespace Differ\Formatters;

use function Differ\Formatters\JsonFormatter\jsonFormat;
use function Differ\Formatters\PlainFormatter\plainFormat;
use function Differ\Formatters\StylishFormatter\stylishFormat;

function format($diff, $format)
{
  $formatter = [
    'stylish' => fn($data) => stylishFormat($data),
    'plain' => fn($data) => plainFormat($data),
    'json' => fn($data) => jsonFormat($data)
  ];
  $result = $formatter[$format]($diff);
  return $result;
}
