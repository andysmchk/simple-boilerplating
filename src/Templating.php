<?php

namespace Rewsam\SimpleBoilerplating;

class Templating
{
    /**
     * @var TemplatingBuilder
     */
    private $builder;

    public function __construct(TemplatingBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function run(): void
    {
        $strategy = $this->builder->getCollectorStrategy();
        $inputCollector = new InputParameterCollector($strategy);
        $parameters = $this->builder->getParameters();
        $bag = $inputCollector->collect($parameters);

        $driver = $this->builder->getDriver();
        $render = new ParametrisedRender($driver, $bag);

        $factory = new TemplateFactory($render);
        $builder = new TemplateBuilderComposite();
        $definitions = $this->builder->getDefinitions();
        $builder->add(new FromDefinitionsTemplateBuilder($factory, $definitions));

        $writer = new TemplateWriter($this->builder->getWriter());
        $writer->write($builder->build());
    }
}