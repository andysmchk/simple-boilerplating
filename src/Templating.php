<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Collector\InputParameterCollector;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;

class Templating
{
    /**
     * @var InputParameterCollector
     */
    private $collector;
    /**
     * @var TemplateWriter
     */
    private $writer;
    /**
     * @var TemplateBuilder
     */
    private $builder;

    public function __construct(InputParameterCollector $collector, TemplateWriter $writer, TemplateBuilder $builder)
    {
        $this->collector = $collector;
        $this->writer = $writer;
        $this->builder = $builder;
    }

    public function run(): void
    {
        $bags = $this->collector->collect();
        $template = $this->builder->build($bags->toSingle());
        $this->writer->write($template);
    }
}