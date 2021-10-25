<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilder;

final class FromDefinitionsBuilderTemplateBuilder implements TemplateBuilder
{
    /**
     * @var TemplateFactory
     */
    private $factory;
    /**
     * @var TemplateDefinitionsBuilder
     */
    private $definitions;

    public function __construct(TemplateFactory $factory, TemplateDefinitionsBuilder $definitions)
    {
        $this->factory = $factory;
        $this->definitions = $definitions;
    }

    public function build(ParametersBag $bag): Template
    {
        $aggregate = new TemplateAggregate();

        foreach ($this->definitions->build() as $item) {
            $aggregate->add($this->factory->create($item, $bag));
        }

        return $aggregate;
    }
}