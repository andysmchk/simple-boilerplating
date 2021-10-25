<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

final class TemplateDefinition
{
    public function __construct(
        private string $sourcePath,
        private string $destinationPath, private string $mode
    ) {}

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