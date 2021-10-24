<?php

namespace Rewsam\SimpleBoilerplating\Input;

/**
 * @codeCoverageIgnore
 */
interface InputRequirement
{
    public function describe(InputParameterDefinitions $definitions): void;
}