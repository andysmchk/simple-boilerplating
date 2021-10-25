<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

/**
 * @codeCoverageIgnore
 */
interface InputRequirement
{
    public function describe(InputParameterDefinitions $definitions): void;
}