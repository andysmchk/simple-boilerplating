<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @codeCoverageIgnore
 */
interface InputBagFactory
{
    public function instantiateBag(): ParametersBag;
}