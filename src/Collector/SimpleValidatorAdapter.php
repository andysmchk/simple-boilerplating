<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\Constraints;

/**
 * @codeCoverageIgnore
 */
interface SimpleValidatorAdapter
{
    public function validate(mixed $value, Constraints $constraints): SimpleValidationResult;
}