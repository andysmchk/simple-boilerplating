<?php

namespace Rewsam\SimpleBoilerplating\Input;

interface InputRequirement
{
    public function describe(InputParameterDefinitions $definitions): void;
}