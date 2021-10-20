<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Rewsam\SimpleBoilerplating\Template\TemplateDefinition;

class TemplateDefinitionTest extends TestCase
{
    /**
     * @dataProvider modeProvider
     */
    public function testCreateWithModes(string $mode): void
    {
        $source = 'source';
        $destination = 'dest';

        $definition = new TemplateDefinition($source, $destination, $mode);
        self::assertSame($destination, $definition->getDestinationPath());
        self::assertSame($source, $definition->getSourcePath());
        self::assertSame($mode, $definition->getMode());
    }

    public function testWrongMode(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new TemplateDefinition('dest', 'source', 'boop');
    }

    public function modeProvider(): array
    {
        return [
            [TemplateDefinition::SAVE_MODE_APPEND],
            [TemplateDefinition::SAVE_MODE_DUMP],
        ];
    }
}
