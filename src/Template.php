<?php

namespace Rewsam\SimpleBoilerplating;

interface Template
{
    public function write(Writer $writer): void;
}