<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

final class ReactorInputParameterCollectorDecorator implements InputParameterCollector
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

    public function collect(): ParametersBags
    {
        $bags = $this->collector->collect();

        foreach ($bags as $bag) {
            if ($this->reactor->supports($bag)) {
                $this->reactor->react($bag);
            }
        }

        return $bags;
    }
}