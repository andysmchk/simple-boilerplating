<?php

namespace Rewsam\SimpleBoilerplating;

class FromDefinitionsTemplateBuilder implements TemplateBuilder
{
    /**
     * @var TemplateFactory
     */
    private $factory;
    /**
     * @var TemplateDefinitions
     */
    private $definitions;

    public function __construct(TemplateFactory $factory, TemplateDefinitions $definitions)
    {
        $this->factory = $factory;
        $this->definitions = $definitions;
    }

    public function build(): Template
    {
        $aggregate = new TemplateAggregate();

        foreach ($this->definitions as $item) {
            $aggregate->add($this->factory->create($item));
        }

        return $aggregate;

    }
}