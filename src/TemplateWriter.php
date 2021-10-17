<?php

namespace Rewsam\SimpleBoilerplating;

class TemplateWriter
{
    /**
     * @var Writer
     */
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function write(Template $template): void
    {
        $template->write($this->writer);
    }
}