<?php

namespace Rewsam\SimpleBoilerplating;

class TemplateAggregate implements Template
{
    /**
     * @var Template[]
     */
    private $templates = [];

    public function add(Template $template): void
    {
        $this->templates[] = $template;
    }

    public function write(Writer $writer): void
    {
        foreach ($this->templates as $template) {
            $template->write($writer);
        }
    }
}