<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\DefaultParametersBag;
use Rewsam\SimpleBoilerplating\ParametersBag;

abstract class AbstractInputOperator implements InputOperator
{
    public function instantiateBag(): ParametersBag
    {
        return new DefaultParametersBag();
    }
}