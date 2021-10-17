<?php

namespace Rewsam\SimpleBoilerplating;

use Exception;
use Traversable;

class TemplateDefinitions implements \IteratorAggregate
{
    /**
     * @var string
     */
    private $baseSourcePath;
    /**
     * @var string
     */
    private $baseDestinationPath;

    /**
     * @var TemplateDefinition
     */
    private $templates = [];

    public function __construct(string $baseSourcePath = '', string $baseDestinationPath = '')
    {
        $this->baseSourcePath = $baseSourcePath;
        $this->baseDestinationPath = $baseDestinationPath;
    }

    public function addTemplate(string $source, string $destination, string $writeMode): void
    {
        $source = $this->baseSourcePath ? ($this->baseSourcePath . DIRECTORY_SEPARATOR . $source) : $source;
        $destination = $this->baseDestinationPath ? ($this->baseDestinationPath . DIRECTORY_SEPARATOR . $destination) : $destination;

        $this->templates[] = new TemplateDefinition($source, $destination, $writeMode);
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->templates);
    }
}