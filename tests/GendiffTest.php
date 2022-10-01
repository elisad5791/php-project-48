<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;
use function Differ\Gendiff\genDiff;
use function Differ\Parsers\parse;

class GendiffTest extends TestCase
{
  private $expected;

  public function setUp(): void
  {
    $path = 'tests/fixtures/resultStylish.txt';
    $this->expected = file_get_contents($path);
  }

  public function testGendiffJson(): void
  {
    $path1 = 'tests/fixtures/file1.json';
    $path2 = 'tests/fixtures/file2.json';
    $result = genDiff($path1, $path2);
    $this->assertEquals($this->expected, $result);
  }

  public function testGendiffYml(): void
  {
    $path1 = 'tests/fixtures/file1.yml';
    $path2 = 'tests/fixtures/file2.yml';
    $result = genDiff($path1, $path2);
    $this->assertEquals($this->expected, $result);
  }
}