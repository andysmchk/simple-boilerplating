<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\Constraints;

/**
 * @codeCoverageIgnore
 */
interface SimpleValidatorAdapter
{
    /** @param mixed $value */
    public function validate($value, Constraints $constraints): SimpleValidationResult;
}