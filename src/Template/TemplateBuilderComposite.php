<?php

namespace Rewsam\SimpleBoilerplating\Template;

class TemplateBuilderComposite implements TemplateBuilder
{
    /** @var TemplateBuilder[]  */
    private $builders = [];

    public function build(): Template
    {
        $template = new TemplateAggregate();

        foreach ($this->builders as $builder) {
            $template->add($builder->build());
        }

        return $template;
    }

    public function add(TemplateBuilder $builder): void
    {
        $this->builders[] = $builder;
    }
}