<?php

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

final class TemplateDefinitionsConfigTreeReader
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /** @return TemplateDefinitionsConfigTreeDestinationNode[] */
    public function read(): iterable
    {
        foreach ($this->config as $destinationConfig) {
            yield new TemplateDefinitionsConfigTreeDestinationNode($destinationConfig);
        }
    }
}