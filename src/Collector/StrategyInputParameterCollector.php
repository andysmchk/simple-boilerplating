<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinitions;
use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

final class StrategyInputParameterCollector implements InputParameterCollector
{
    public function __construct(
        private InputParameterCollectorStrategy $parameterCollectorStrategy,
        private Inputs $inputs
    ) {}

    public function collect(): ParametersBags
    {
        $bags = new ParametersBags();

        foreach ($this->inputs as $input) {
            $requirement = $input->getInputRequirement();
            $definitions = new InputParameterDefinitions();
            $requirement->describe($definitions);
            $factory = $input->getInputBagFactory();
            $bag = $factory->instantiateBag();

            foreach ($definitions as $definition) {
                $value = $this->parameterCollectorStrategy->fetch($definition);
                $bag->set($definition->getKey(), $value);
            }
            $bags->add($bag);
        }

        return $bags;
    }
}