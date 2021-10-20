<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Writer\Writer;

interface Template
{
    public function write(Writer $writer): void;
}