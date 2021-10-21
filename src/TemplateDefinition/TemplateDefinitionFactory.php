<?php

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

interface TemplateDefinitionFactory
{
    public function make(string $source, string $destination, string $writeMode): TemplateDefinition;
}