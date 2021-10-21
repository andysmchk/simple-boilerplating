<?php

namespace Rewsam\SimpleBoilerplating\Template;

interface TemplateDefinitionFactory
{
    public function make(string $source, string $destination, string $writeMode): TemplateDefinition;
}