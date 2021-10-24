<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeFileNode;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsConfigTreeFileNode
 */
class TemplateDefinitionsConfigTreeFileNodeTest extends TestCase
{
    use ProphecyTrait;

    public function testValid(): void
    {
        $config = [
            'source' => 'from.txt',
            'destination' => 'destination.php',
            'mode' => 'dump',
        ];

        $sut = new TemplateDefinitionsConfigTreeFileNode($config);
        self::assertSame($config['source'], $sut->getSource());
        self::assertSame($config['destination'], $sut->getDestination());
        self::assertSame($config['mode'], $sut->getMode());
    }

    /**
     * @dataProvider providerInvalid
     */
    public function testInvalid($config, $exceptionClass): void
    {
        $this->expectException($exceptionClass);

        new TemplateDefinitionsConfigTreeFileNode($config);
    }

    public function providerInvalid(): array
    {
        return [
            [
                [
                    'source' => '',
                    'destination' => 'destination.php',
                    'mode' => 'dump',
                ],
                \InvalidArgumentException::class
            ],
            [
                [
                    'source' => 'from.txt',
                    'destination' => '',
                    'mode' => 'dump',
                ],
                \InvalidArgumentException::class
            ],
            [
                [
                    'source' => 'from.txt',
                    'destination' => 'destination.php',
                    'mode' => '',
                ],
                \InvalidArgumentException::class
            ],
        ];
    }
}
