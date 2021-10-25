<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

use Rewsam\SimpleBoilerplating\Template\PathPrefixer;

final class BasePathTemplateDefinitionFactory implements TemplateDefinitionFactory
{
    private PathPrefixer $baseSourcePath;
    private PathPrefixer $baseDestinationPath;

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