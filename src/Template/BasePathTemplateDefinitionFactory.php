<?php

namespace Rewsam\SimpleBoilerplating\Template;

class BasePathTemplateDefinitionFactory implements TemplateDefinitionFactory
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
        $this->baseSourcePath = new PathPrefixer($baseSourcePath);
        $this->baseDestinationPath = new PathPrefixer($baseDestinationPath);
    }

    public function make(string $source, string $destination, string $writeMode): TemplateDefinition
    {
        $source = $this->baseSourcePath->prefixPath($source);
        $destination = $this->baseDestinationPath->prefixPath($destination);

        return new TemplateDefinition($source, $destination, $writeMode);
    }
}