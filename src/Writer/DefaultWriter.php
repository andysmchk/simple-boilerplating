<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Writer;

final class DefaultWriter implements Writer
{
    public function __construct(
        private WriterAdapter $filesystem,
        private bool $dry,
        private bool $override
    ) {}

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