<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

/**
 * @codeCoverageIgnore
 */
interface InputParameterCollector
{
    public function collect(): ParametersBags;
}