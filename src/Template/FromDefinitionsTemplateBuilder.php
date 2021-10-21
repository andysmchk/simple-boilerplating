<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

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

    public function build(ParametersBag $bag): Template
    {
        $aggregate = new TemplateAggregate();

        foreach ($this->definitions as $item) {
            $aggregate->add($this->factory->create($item, $bag));
        }

        return $aggregate;
    }
}