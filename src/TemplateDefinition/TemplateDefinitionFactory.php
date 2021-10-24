<?php

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

/**
 * @codeCoverageIgnore
 */
interface TemplateDefinitionFactory
{
    public function make(string $source, string $destination, string $writeMode): TemplateDefinition;
}