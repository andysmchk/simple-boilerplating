<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilder;

final class FromDefinitionsBuilderTemplateBuilder implements TemplateBuilder
{
    public function __construct(
        private TemplateFactory $factory,
        private TemplateDefinitionsBuilder $definitions
    ) {}

    public function build(ParametersBag $bag): Template
    {
        $aggregate = new TemplateAggregate();

        foreach ($this->definitions->build() as $item) {
            $aggregate->add($this->factory->create($item, $bag));
        }

        return $aggregate;
    }
}