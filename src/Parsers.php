<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($path)
{
  $parsers = [
    'json' => fn($str) => json_decode($str, true),
    'yml' => fn($str) => Yaml::parse($str),
    'yaml' => fn($str) => Yaml::parse($str),  
  ];

  $path_info = pathinfo($path);
  $ext = $path_info['extension'];
  $content = file_get_contents($path);
  $data = $parsers[$ext]($content);

  return  $data;
}