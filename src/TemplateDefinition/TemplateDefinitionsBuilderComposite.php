<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

final class TemplateDefinitionsBuilderComposite implements TemplateDefinitionsBuilder
{
    /**
     * @var TemplateDefinitionsBuilder[]
     */
    private array $builders = [];

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