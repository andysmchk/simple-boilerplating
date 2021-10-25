<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

final class ReactorInputParameterCollectorDecorator implements InputParameterCollector
{
    public function __construct(
        private InputParameterCollector $collector,
        private InputReactor $reactor
    ) {}

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