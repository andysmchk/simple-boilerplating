<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Writer\Writer;

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