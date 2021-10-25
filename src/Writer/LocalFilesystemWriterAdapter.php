<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Writer;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter;

final class LocalFilesystemWriterAdapter implements WriterAdapter
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public static function create(string $basePath): self
    {
        $adapter = new LocalFilesystemAdapter($basePath);
        $filesystem = new Filesystem($adapter);

        return new self($filesystem);
    }

    /**
     * @throws FilesystemException
     */
    public function exists(string $destination): bool
    {
        return $this->filesystem->fileExists($destination);
    }

    /**
     * @throws FilesystemException
     */
    public function writeTo(string $destination, string $content): void
    {
        $this->filesystem->write($destination, $content);
    }

    /**
     * @throws FilesystemException
     */
    public function readFrom(string $destination): string
    {
        return $this->filesystem->read($destination);
    }
}