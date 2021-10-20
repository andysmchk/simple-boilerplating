<?php

namespace Rewsam\SimpleBoilerplating\Template;

interface TemplateBuilder
{
    public function build(): Template;
}