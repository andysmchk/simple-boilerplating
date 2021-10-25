<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Writer;

/**
 * @codeCoverageIgnore
 */
interface Writer
{
    public function exists(string $destination): bool;

    public function dump(string $destination, string $content): void;

    public function append(string $destination, string $content): void;
}