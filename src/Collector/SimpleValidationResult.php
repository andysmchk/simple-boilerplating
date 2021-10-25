<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

/**
 * @codeCoverageIgnore
 */
interface SimpleValidationResult
{
    public function getMultilineMessage(): string;
}