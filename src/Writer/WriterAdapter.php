<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Writer;

/**
 * @codeCoverageIgnore
 */
interface WriterAdapter
{
    public function exists(string $destination): bool;

    public function writeTo(string $destination, string $content): void;

    public function readFrom(string $destination): string;
}