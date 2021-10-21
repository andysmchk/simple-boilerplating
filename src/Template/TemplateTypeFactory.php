<?php

namespace Rewsam\SimpleBoilerplating\Template;

interface TemplateTypeFactory
{
    public function create(string $destinations, string $content): Template;
}