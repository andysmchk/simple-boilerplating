<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParametersBag;

interface InputReactor
{
    public function react(ParametersBag $bag): void;

    public function supports(ParametersBag $bag): bool;
}