<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Collector\InputParameterCollector;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;

final class Templating
{
    public function __construct(
        private InputParameterCollector $collector,
        private TemplateWriter $writer,
        private TemplateBuilder $builder
    ) {}

    public function run(): void
    {
        $bags = $this->collector->collect();
        $template = $this->builder->build($bags->toSingle());
        $this->writer->write($template);
    }
}