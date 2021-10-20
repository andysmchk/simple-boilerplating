<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

class ReactorInputParameterCollectorDecorator implements InputParameterCollector
{
    /**
     * @var InputParameterCollector
     */
    private $collector;
    /**
     * @var InputReactor
     */
    private $reactor;

    public function __construct(InputParameterCollector $collector, InputReactor $reactor)
    {
        $this->collector = $collector;
        $this->reactor = $reactor;
    }

    public function collect(Inputs $inputs): ParametersBags
    {
        $bags = $this->collector->collect($inputs);

        foreach ($bags as $bag) {
            if ($this->reactor->supports($bag)) {
                $this->reactor->react($bag);
            }
        }

        return $bags;
    }
}