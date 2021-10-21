<?php

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

final class TemplateDefinitionsConfigTreeDestinationNode
{
    /** @var string  */
    private $destinationBasePath;

    /** @var string  */
    private $sourceBasePath;

    /** @var array  */
    private $filesConfig = [];

    public function __construct(array $config)
    {
        $this->destinationBasePath = (string) ($config['destination_directory'] ?? '');
        $this->sourceBasePath = (string) ($config['source_directory'] ?? '');
        $files = $config['files'] ?? [];

        if (is_array($files)) {
            $this->filesConfig = $files;
        }
    }

    /** @return TemplateDefinitionsConfigTreeFileNode[] */
    public function files(): iterable
    {
        foreach ($this->filesConfig as $file) {
            yield new TemplateDefinitionsConfigTreeFileNode($file);
        }
    }

    public function getDestinationBasePath(): string
    {
        return $this->destinationBasePath;
    }

    public function getSourceBasePath(): string
    {
        return $this->sourceBasePath;
    }
}