<?php

namespace Rewsam\SimpleBoilerplating\Template;

class TemplateDefinition
{
    public const SAVE_MODE_APPEND = 'append';
    public const SAVE_MODE_DUMP   = 'dump';

    public const SAVE_MODES = [
        self::SAVE_MODE_APPEND,
        self::SAVE_MODE_DUMP,
    ];

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

        if (!in_array($mode, self::SAVE_MODES)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid mode given expected one of: %s, but %s was given instead', implode(', ', self::SAVE_MODES), $mode)
            );
        }
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