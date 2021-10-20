<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParametersBag;

interface InputBagFactory
{
    public function instantiateBag(): ParametersBag;
}