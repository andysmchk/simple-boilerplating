<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParameterBag\ArrayParametersBag;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

abstract class AbstractInputOperator implements InputOperator
{
    public function instantiateBag(): ParametersBag
    {
        return new ArrayParametersBag();
    }
}