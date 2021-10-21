<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Rewsam\SimpleBoilerplating\Template\AppendTemplate;
use Rewsam\SimpleBoilerplating\Template\DumpTemplate;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;

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

    public function modeProvider(): array
    {
        return [
            [AppendTemplate::TYPE],
            [DumpTemplate::TYPE],
        ];
    }
}
