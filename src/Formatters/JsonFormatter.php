<?php

namespace Differ\Formatters\JsonFormatter;

function jsonFormat(array $diff)
{
    return json_encode($diff);
}
