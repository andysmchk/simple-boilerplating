<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

final class TemplateDefinitionsConfigTreeReader
{
    public function __construct(private array $config) {}

    /** @return TemplateDefinitionsConfigTreeDestinationNode[] */
    public function read(): iterable
    {
        foreach ($this->config as $destinationConfig) {
            yield new TemplateDefinitionsConfigTreeDestinationNode($destinationConfig);
        }
    }
}