<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

use InvalidArgumentException;

final class TemplateDefinitionsConfigTreeFileNode
{
    /** @var string */
    private $source;

    /** @var string */
    private $destination;

    /** @var string */
    private $mode;

    public function __construct(array $config)
    {
        $this->destination = $config['destination'] ?? null;
        $this->source = $config['source'] ?? null;
        $this->mode = $config['mode'] ?? null;

        if (!$this->destination) {
            throw new InvalidArgumentException('Destination file path is required');
        }

        if (!$this->source) {
            throw new InvalidArgumentException('Source file path is required');
        }

        if (!$this->mode) {
            throw new InvalidArgumentException('Template mode is required');
        }
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getMode(): string
    {
        return $this->mode;
    }
}