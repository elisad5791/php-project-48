<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $path)
{
    $parsers = [
    'json' => fn($str) => json_decode($str, true),
    'yml' => fn($str) => Yaml::parse($str),
    'yaml' => fn($str) => Yaml::parse($str),
    ];

    $arr = explode('.', $path);
    $ext = end($arr);
    $content = file_get_contents($path);
    $data = $parsers[$ext]($content);

    return  $data;
}
