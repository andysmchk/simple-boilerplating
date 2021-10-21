<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

class TemplateBuilderComposite implements TemplateBuilder
{
    /** @var TemplateBuilder[]  */
    private $builders = [];

    public function build(ParametersBag $bag): Template
    {
        $template = new TemplateAggregate();

        foreach ($this->builders as $builder) {
            $template->add($builder->build($bag));
        }

        return $template;
    }

    public function add(TemplateBuilder $builder): void
    {
        $this->builders[] = $builder;
    }
}