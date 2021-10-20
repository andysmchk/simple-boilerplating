<?php

namespace Rewsam\SimpleBoilerplating\Input;

interface InputParameterDefinition
{
    public function getKey(): string;
    public function getDescription(): string;
    public function getConstraints(): Constraints;
}