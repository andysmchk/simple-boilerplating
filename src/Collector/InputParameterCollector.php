<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

interface InputParameterCollector
{
    public function collect(): ParametersBags;
}