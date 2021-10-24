<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @codeCoverageIgnore
 */
interface Template
{
    public function write(Writer $writer): void;
}