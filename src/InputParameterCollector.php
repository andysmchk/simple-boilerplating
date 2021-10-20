<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

interface InputParameterCollector
{
    public function collect(Inputs $inputs): ParametersBags;
}