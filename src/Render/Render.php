<?php

namespace Rewsam\SimpleBoilerplating\Render;

interface Render
{
    public function renderTemplate(string $path): string;

    public function renderString(string $template): string;
}