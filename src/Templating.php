<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Collector\ReactorInputParameterCollectorDecorator;
use Rewsam\SimpleBoilerplating\Collector\StrategyInputParameterCollector;
use Rewsam\SimpleBoilerplating\Template\FromDefinitionsTemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilderComposite;
use Rewsam\SimpleBoilerplating\TemplatingBuilder;

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
        $reactor = $this->builder->getReactor();
        $inputCollector = new StrategyInputParameterCollector($strategy);
        $inputCollector = new ReactorInputParameterCollectorDecorator($inputCollector, $reactor);
        $parameters = $this->builder->getParameters();
        $bags = $inputCollector->collect($parameters);

        $driver = $this->builder->getDriver();
        $render = new ParametrisedRender($driver, $bags->toSingle());

        $factory = new TemplateFactory($render);
        $builder = new TemplateBuilderComposite();
        $definitions = $this->builder->getDefinitions();
        $builder->add(new FromDefinitionsTemplateBuilder($factory, $definitions));

        $writer = new TemplateWriter($this->builder->getWriter());
        $writer->write($builder->build());
    }
}