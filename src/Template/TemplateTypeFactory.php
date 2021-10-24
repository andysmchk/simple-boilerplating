<?php

namespace Rewsam\SimpleBoilerplating\Template;

/**
 * @codeCoverageIgnore
 */
interface TemplateTypeFactory
{
    public function create(string $destinations, string $content): Template;
}