<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @codeCoverageIgnore
 */
interface Template
{
    public function write(Writer $writer): void;
}