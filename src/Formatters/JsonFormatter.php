<?php

namespace Differ\Formatters\JsonFormatter;

function jsonFormat($diff)
{
  return json_encode($diff);
}
