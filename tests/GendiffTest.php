<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;
use function Differ\Differ\genDiff;
use function Differ\Parsers\parse;

class GendiffTest extends TestCase
{
  private $pathJson1;
  private $pathJson2;
  private $pathYml1;
  private $pathYml2;

  public function setUp(): void
  {
    $this->pathJson1 = 'tests/fixtures/file1.json';
    $this->pathJson2 = 'tests/fixtures/file2.json';
    $this->pathYml1 = 'tests/fixtures/file1.yml';
    $this->pathYml2 = 'tests/fixtures/file2.yml';
  }

  public function testGendiffPlain(): void
  {
    $path = 'tests/fixtures/resultPlain.txt';
    $expected = file_get_contents($path);
    $resultJson = genDiff($this->pathJson1, $this->pathJson2, 'plain');
    $resultYml = genDiff($this->pathYml1, $this->pathYml2, 'plain');
    $this->assertEquals($expected, $resultJson);
    $this->assertEquals($expected, $resultYml);
  }

  public function testGendiffStylish(): void
  {
    $path = 'tests/fixtures/resultStylish.txt';
    $expected = file_get_contents($path);
    $resultJson = genDiff($this->pathJson1, $this->pathJson2);
    $resultYml = genDiff($this->pathYml1, $this->pathYml2);
    $this->assertEquals($expected, $resultJson);
    $this->assertEquals($expected, $resultYml);
  }
}