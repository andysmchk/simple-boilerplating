<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

interface InputParameterCollectorStrategy
{
    public function fetch(InputParameterDefinition $definition): string;
}