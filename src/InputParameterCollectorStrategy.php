<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

interface InputParameterCollectorStrategy
{
    public function fetch(InputParameterDefinition $definition): string;
}