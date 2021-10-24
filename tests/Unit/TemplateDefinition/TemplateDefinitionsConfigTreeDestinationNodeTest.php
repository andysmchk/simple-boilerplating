<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeDestinationNode;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeDestinationNode
 */
class TemplateDefinitionsConfigTreeDestinationNodeTest extends TestCase
{
    use ProphecyTrait;

    public function testDefaults(): void
    {
        $config = [];

        $sut = new TemplateDefinitionsConfigTreeDestinationNode($config);
        self::assertEmpty(iterator_to_array($sut->files()));
        self::assertSame('', $sut->getDestinationBasePath());
        self::assertSame('', $sut->getSourceBasePath());
    }

    public function testFiles(): void
    {
        $config = [
            'files' => [
                [
                    'source' => 'from.txt',
                    'destination' => 'destination.php',
                    'mode' => 'dump',
                ],
                [
                    'source' => 'from0.txt',
                    'destination' => 'destination0.php',
                    'mode' => 'dump',
                ],
            ],
        ];

        $sut = new TemplateDefinitionsConfigTreeDestinationNode($config);
        self::assertCount(2, iterator_to_array($sut->files()));
    }

    public function testGetDestinationBasePath(): void
    {
        $config = [
            'destination_directory' => 'dest'
        ];

        $sut = new TemplateDefinitionsConfigTreeDestinationNode($config);
        self::assertSame('dest', $sut->getDestinationBasePath());
    }

    public function testGetSourceBasePath(): void
    {
        $config = [
            'source_directory' => 'test',
        ];

        $sut = new TemplateDefinitionsConfigTreeDestinationNode($config);
        self::assertSame('test', $sut->getSourceBasePath());
    }
}
