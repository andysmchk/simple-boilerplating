<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Input\Inputs;

interface InputParameterCollector
{
    public function collect(Inputs $inputs): ParametersBags;
}