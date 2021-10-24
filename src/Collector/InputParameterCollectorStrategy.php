<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

/**
 * @codeCoverageIgnore
 */
interface InputParameterCollectorStrategy
{
    public function fetch(InputParameterDefinition $definition): string;
}