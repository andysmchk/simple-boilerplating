<?php

namespace Rewsam\SimpleBoilerplating\Writer;

class DefaultWriter implements Writer
{
    /**
     * @var WriterAdapter
     */
    private $filesystem;
    /**
     * @var bool
     */
    private $dry;
    /**
     * @var bool
     */
    private $override;

    public function __construct(WriterAdapter $filesystem, bool $dry, bool $override)
    {
        $this->filesystem = $filesystem;
        $this->dry = $dry;
        $this->override = $override;
    }

    public static function createWithLocalFilesystem(string $basePath, bool $dry, bool $override): self
    {
        return new self(LocalFilesystemWriterAdapter::create($basePath), $dry, $override);
    }

    public function exists(string $destination): bool
    {
        return $this->filesystem->exists($destination);
    }

    public function dump(string $destination, string $content): void
    {
        if ($this->dry) {
            return;
        }

        if ($this->override || !$this->exists($destination)) {
            $this->filesystem->writeTo($destination, $content);
        }
    }

    public function append(string $destination, string $content): void
    {
        if ($this->dry) {
            return;
        }

        if ($this->exists($destination)) {
            $original = $this->filesystem->readFrom($destination);
            $content = str_replace($content, '', $original) . $content;

            $this->filesystem->writeTo($destination, $content);
        }
    }
}