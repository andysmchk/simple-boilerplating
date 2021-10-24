<?php

namespace Rewsam\SimpleBoilerplating\Input;

/**
 * @codeCoverageIgnore
 */
interface InputParameterDefinition
{
    public function getKey(): string;
    public function getDescription(): string;
    public function getConstraints(): Constraints;
}