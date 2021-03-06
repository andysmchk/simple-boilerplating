<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;

final class FromDefinitionsTemplateBuilder implements TemplateBuilder
{
    public function __construct(
        private TemplateFactory $factory,
        private TemplateDefinitions $definitions
    ) {}

    public function build(ParametersBag $bag): Template
    {
        $aggregate = new TemplateAggregate();

        foreach ($this->definitions as $item) {
            $aggregate->add($this->factory->create($item, $bag));
        }

        return $aggregate;
    }
}