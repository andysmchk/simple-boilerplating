<?php

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

class TemplateDefinitionsBuilderComposite implements TemplateDefinitionsBuilder
{
    /**
     * @var TemplateDefinitionsBuilder[]
     */
    private $builders = [];

    public function addBuilder(TemplateDefinitionsBuilder $builder): void
    {
        $this->builders[] = $builder;
    }

    public function build(): TemplateDefinitions
    {
        $definitions = new TemplateDefinitions();

        foreach ($this->builders as $builder) {
            $definitions->mergeCollection($builder->build());
        }

        return $definitions;
    }
}