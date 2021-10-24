<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition
 */
class TemplateDefinitionTest extends TestCase
{
    use ProphecyTrait;

    public function testValid(): void
    {
        $sourcePath = '42453fsdff';
        $destinationPath = '42435fsd ';
        $mode = '4435342';
        $sut = new TemplateDefinition($sourcePath, $destinationPath, $mode);
        self::assertSame($sourcePath, $sut->getSourcePath());
        self::assertSame($destinationPath, $sut->getDestinationPath());
        self::assertSame($mode, $sut->getMode());
    }
}
