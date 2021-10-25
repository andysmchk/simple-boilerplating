<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

/**
 * @extends GenericCollection<TemplateDefinition>
 */
final class TemplateDefinitions extends GenericCollection
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