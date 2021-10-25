<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @codeCoverageIgnore
 */
interface InputBagFactory
{
    public function instantiateBag(): ParametersBag;
}