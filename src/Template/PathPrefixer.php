<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

final class PathPrefixer
{
    public function __construct(
        private string $prefix,
        private string $separator = DIRECTORY_SEPARATOR
    ) {}

    public function prefixPath(string $path): string
    {
        return $this->prefix ? ($this->prefix . $this->separator . $path) : $path;
    }
}