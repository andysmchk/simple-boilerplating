<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

/**
 * @codeCoverageIgnore
 */
interface InputReactor
{
    public function react(ParametersBag $bag): void;

    public function supports(ParametersBag $bag): bool;
}