<?php

namespace Rewsam\SimpleBoilerplating;

interface Writer
{
    public function exists(string $destination): bool;

    public function dump(string $destination, string $content): void;

    public function append(string $destination, string $content): void;
}