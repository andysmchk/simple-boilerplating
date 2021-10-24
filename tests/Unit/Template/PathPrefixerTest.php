<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Template\PathPrefixer;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\PathPrefixer
 */
class PathPrefixerTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider prefixProvider
     */
    public function testPrefixPath(string $prefix, string $separator, string $path, string $result): void
    {
        $sut = new PathPrefixer($prefix, $separator);
        self::assertSame($result, $sut->prefixPath($path));
    }

    public function prefixProvider(): array
    {
        return [
            ['directory', '/', 'path', 'directory/path'],
            ['', '/', 'path', 'path'],
            ['directory/nested', '/', 'path', 'directory/nested/path'],
            ['directory', '-', 'path', 'directory-path'],
            ['directory', '/', '', 'directory/'],
            ['', '/', '', ''],
        ];
    }
}
