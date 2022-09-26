<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use function App\Gendiff\genDiff;

class GendiffTest extends TestCase
{
  public function testGendiff(): void
  {
    $path1 = 'tests/fixtures/file1.json';
    $path2 = 'tests/fixtures/file2.json';
    $path3 = 'tests/fixtures/result.json';
    $data1 = (array) json_decode(file_get_contents($path1));
    $data2 = (array) json_decode(file_get_contents($path2));
    $expected = (array) json_decode(file_get_contents($path3));
    $result = genDiff($data1, $data2);
    $this->assertEquals($expected, $result);
  }
}