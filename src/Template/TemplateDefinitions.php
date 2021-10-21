<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

/**
 * @extends GenericCollection<TemplateDefinition>
 */
class TemplateDefinitions extends GenericCollection
{
    public function add(TemplateDefinition ...$template): void
    {
        $this->merge($template);
    }

    public function mergeCollection(TemplateDefinitions $definitions): void
    {
        foreach ($definitions as $definition) {
            $this->add($definition);
        }
    }
}