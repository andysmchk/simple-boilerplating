<?php

namespace Rewsam\SimpleBoilerplating\Template;

final class PathPrefixer
{
    /**
     * @var string
     */
    private $prefix;
    /**
     * @var string
     */
    private $separator;

    public function __construct(string $prefix, string $separator = DIRECTORY_SEPARATOR)
    {
        $this->prefix = $prefix;
        $this->separator = $separator;
    }

    public function prefixPath(string $path): string
    {
        return $this->prefix ? ($this->prefix . $this->separator . $path) : $path;
    }
}