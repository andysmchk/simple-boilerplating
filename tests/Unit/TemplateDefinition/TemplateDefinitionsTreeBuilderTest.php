<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeReader;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsTreeBuilder;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsTreeBuilder
 */
class TemplateDefinitionsTreeBuilderTest extends TestCase
{
    use ProphecyTrait;

    public function testBuild(): void
    {
        $config = [
            [
                'source_directory' => 'test',
                'destination_directory' => 'dest',
                'files' => [
                    [
                        'source' => 'from.txt',
                        'destination' => 'destination.php',
                        'mode' => 'dump',
                    ],
                    [
                        'source' => 'from0.txt',
                        'destination' => 'destination0.php',
                        'mode' => 'append',
                    ],
                ],
            ],
        ];

        $expected = [
            [
                'source' => 'test/from.txt',
                'destination' => 'dest/destination.php',
                'mode' => 'dump',
            ],
            [
                'source' => 'test/from0.txt',
                'destination' => 'dest/destination0.php',
                'mode' => 'append',
            ],
        ];

        $sut = new TemplateDefinitionsTreeBuilder($config);

        /**
         * @var int $key
         * @var TemplateDefinition $item
         */
        foreach ($sut->build() as $key => $item) {
            self::assertIsInt($key);
            self::assertSame($expected[$key]['source'], $item->getSourcePath());
            self::assertSame($expected[$key]['destination'], $item->getDestinationPath());
            self::assertSame($expected[$key]['mode'], $item->getMode());
        }
    }
}
