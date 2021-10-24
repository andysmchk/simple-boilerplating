<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Collector\ArrayInputParameterCollectorStrategy;
use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\ArrayInputParameterCollectorStrategy
 */
class ArrayInputParameterCollectorStrategyTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var array
     */
    protected $params;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->params = [];
    }

    /**
     * @dataProvider paramsProvider
     */
    public function testFetch(array $params, string $key, $value): void
    {
        ($template = $this->prophesize(InputParameterDefinition::class))
                          ->getKey()
                          ->willReturn($key);

        $sut = new ArrayInputParameterCollectorStrategy($params);
        self::assertSame($value, $sut->fetch($template->reveal()));
    }

    public function paramsProvider(): array
    {
        return [
            [['key' => 'value'], 'key', 'value'],
            [[], 'key', ''],
            [['key' => 'value', 'key2' => 'value2'], 'key2', 'value2'],
        ];
    }
}
