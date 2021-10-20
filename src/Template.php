<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Writer\Writer;

interface Template
{
    public function write(Writer $writer): void;
}