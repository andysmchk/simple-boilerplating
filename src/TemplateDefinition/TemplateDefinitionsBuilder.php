<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

/**
 * @codeCoverageIgnore
 */
interface TemplateDefinitionsBuilder
{
    public function build(): TemplateDefinitions;
}