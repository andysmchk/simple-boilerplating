<?php

namespace Rewsam\SimpleBoilerplating;

class InputParameterCollector
{
    /**
     * @var InputParameterCollectorStrategy
     */
    private $parameterCollectorStrategy;

    public function __construct(InputParameterCollectorStrategy $parameterCollectorStrategy)
    {
        $this->parameterCollectorStrategy = $parameterCollectorStrategy;
    }

    public function collect(InputParameterDefinitions $definitions): ParametersBag
    {
        $bag = new ParametersBag();

        foreach ($definitions as $definition) {
            $value = $this->parameterCollectorStrategy->fetch($definition);
            $bag->add($definition->getKey(), $value);
        }

        return $bag;
    }
}