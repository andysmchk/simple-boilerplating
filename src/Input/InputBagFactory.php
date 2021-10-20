<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

interface InputBagFactory
{
    public function instantiateBag(): ParametersBag;
}