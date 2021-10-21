<?php

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

class TemplateDefinition
{
    /**
     * @var string
     */
    private $sourcePath;
    /**
     * @var string
     */
    private $destinationPath;
    /**
     * @var string
     */
    private $mode;

    public function __construct(string $sourcePath, string $destinationPath, string $mode)
    {
        $this->sourcePath = $sourcePath;
        $this->destinationPath = $destinationPath;
        $this->mode = $mode;
    }

    public function getSourcePath(): string
    {
        return $this->sourcePath;
    }

    public function getDestinationPath(): string
    {
        return $this->destinationPath;
    }

    public function getMode(): string
    {
        return $this->mode;
    }
}