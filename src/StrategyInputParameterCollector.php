<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinitions;
use Rewsam\SimpleBoilerplating\Input\Inputs;

class StrategyInputParameterCollector implements InputParameterCollector
{
    /**
     * @var InputParameterCollectorStrategy
     */
    private $parameterCollectorStrategy;

    public function __construct(InputParameterCollectorStrategy $parameterCollectorStrategy)
    {
        $this->parameterCollectorStrategy = $parameterCollectorStrategy;
    }

    public function collect(Inputs $inputs): ParametersBags
    {
        $bags = new ParametersBags();

        foreach ($inputs as $input) {
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