<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\BasePathTemplateDefinitionFactory;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\BasePathTemplateDefinitionFactory
 */
class BasePathTemplateDefinitionFactoryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider pathProvider
     */
    public function testMake(string $baseSourcePath, string $baseDestinationPath, string $src, string $dst, string $mode, string $expectedSrc, string $expectedDst): void
    {
        $sut = new BasePathTemplateDefinitionFactory($baseSourcePath, $baseDestinationPath);
        $definition = $sut->make($src, $dst, $mode);

        self::assertSame($expectedSrc, $definition->getSourcePath());
        self::assertSame($expectedDst, $definition->getDestinationPath());
        self::assertSame($mode, $definition->getMode());
    }

    public function pathProvider(): array
    {
        return [
            ['src', 'dst', 'source', 'destination', 'testMode', 'src/source', 'dst/destination'],
            ['src', 'dst', '', '', 'testMode', 'src/', 'dst/'],
            ['', '', 'source', 'destination', 'testMode', 'source', 'destination'],
            ['', '', '', '', 'testMode', '', ''],
        ];
    }
}
