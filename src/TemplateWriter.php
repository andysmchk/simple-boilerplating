<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Writer\Writer;

final class TemplateWriter
{
    public function __construct(private Writer $writer) {}

    public function write(Template $template): void
    {
        $template->write($this->writer);
    }
}