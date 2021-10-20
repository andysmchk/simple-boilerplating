<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

/**
 * @extends GenericCollection<TemplateDefinition>
 */
class TemplateDefinitions extends GenericCollection
{
    /**
     * @var string
     */
    private $baseSourcePath;
    /**
     * @var string
     */
    private $baseDestinationPath;

    public function __construct(string $baseSourcePath = '', string $baseDestinationPath = '')
    {
        $this->baseSourcePath = $baseSourcePath;
        $this->baseDestinationPath = $baseDestinationPath;
    }

    public function addTemplate(string $source, string $destination, string $writeMode): void
    {
        $source = $this->baseSourcePath ? ($this->baseSourcePath . DIRECTORY_SEPARATOR . $source) : $source;
        $destination = $this->baseDestinationPath ? ($this->baseDestinationPath . DIRECTORY_SEPARATOR . $destination) : $destination;

        $this->merge([new TemplateDefinition($source, $destination, $writeMode)]);
    }
}