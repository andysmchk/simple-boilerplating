<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeDestinationNode;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeReader;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeReader
 */
class TemplateDefinitionsConfigTreeReaderTest extends TestCase
{
    use ProphecyTrait;

    public function testReadDefault(): void
    {
        $config = [[], []];
        $sut = new TemplateDefinitionsConfigTreeReader($config);
        $result = iterator_to_array($sut->read());
        self::assertCount(2, $result);

        self::assertContainsOnlyInstancesOf(TemplateDefinitionsConfigTreeDestinationNode::class, $result);
    }

    public function testReadValid(): void
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
                        'mode' => 'dump',
                    ],
                ],
            ],
        ];
        $sut = new TemplateDefinitionsConfigTreeReader($config);

        /**
         * @var int $key
         */
        foreach ($sut->read() as $key => $item) {
            self::assertSame($config[$key]['destination_directory'], $item->getDestinationBasePath());
            self::assertSame($config[$key]['source_directory'], $item->getSourceBasePath());

            foreach ($item->files() as $index => $file) {
                self::assertSame($config[$key]['files'][$index]['destination'], $file->getDestination());
                self::assertSame($config[$key]['files'][$index]['source'], $file->getSource());
                self::assertSame($config[$key]['files'][$index]['mode'], $file->getMode());
            }
        }
    }
}
