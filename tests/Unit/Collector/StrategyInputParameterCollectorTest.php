<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collector;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Collector\InputParameterCollectorStrategy;
use Rewsam\SimpleBoilerplating\Collector\StrategyInputParameterCollector;
use Rewsam\SimpleBoilerplating\Input\Input;
use Rewsam\SimpleBoilerplating\Input\InputBagFactory;
use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;
use Rewsam\SimpleBoilerplating\Input\InputParameterDefinitions;
use Rewsam\SimpleBoilerplating\Input\InputRequirement;
use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;

/**
 * @covers \Rewsam\SimpleBoilerplating\Collector\StrategyInputParameterCollector
 */
class StrategyInputParameterCollectorTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var InputParameterCollectorStrategy|ObjectProphecy
     */
    protected $parameterCollectorStrategy;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->parameterCollectorStrategy = $this->prophesize(InputParameterCollectorStrategy::class);
    }

    public function testConstruct(): void
    {
        $inputs = new Inputs();
        $sut = new StrategyInputParameterCollector($this->parameterCollectorStrategy->reveal(), $inputs);
        self::assertEmpty($sut->collect()->toSingle()->all());
    }

    public function testCollect(): void
    {
        $definitionKey = 'key';
        $fetchedValue = 'test';
        $inputRequirement = $this->prophesize(InputRequirement::class);
        $definition = $this->prophesize(InputParameterDefinition::class);
        $definition->getKey()->willReturn($definitionKey)->shouldBeCalledOnce();
        $definition = $definition->reveal();
        $inputRequirement->describe(Argument::type(InputParameterDefinitions::class))->will(function ($args) use ($definition) {
            $definitions = $args[0];
            $definitions->add($definition);
        })->shouldBeCalledOnce();
        $inputBagFactory = $this->prophesize(InputBagFactory::class);
        $bag = $this->prophesize(ParametersBag::class);
        $bag->set($definitionKey, $fetchedValue)->shouldBeCalledOnce();
        $bag->all()->willReturn([$definitionKey => $fetchedValue])->shouldBeCalledOnce();

        $inputBagFactory->instantiateBag()->willReturn($bag->reveal())->shouldBeCalledOnce();

        $inputs = new Inputs();
        $inputs = $inputs->add(new Input($inputRequirement->reveal(), $inputBagFactory->reveal()));
        $this->parameterCollectorStrategy->fetch($definition)->willReturn($fetchedValue)->shouldBeCalledOnce();

        $sut = new StrategyInputParameterCollector($this->parameterCollectorStrategy->reveal(), $inputs);
        $bag = $sut->collect()->toSingle();

        self::assertSame([$definitionKey => $fetchedValue], $bag->all());
    }
}
