<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Writer\Writer;

final class TemplateAggregate implements Template
{
    /**
     * @var Template[]
     */
    private array $templates = [];

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