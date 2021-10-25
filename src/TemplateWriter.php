<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Writer\Writer;

final class TemplateWriter
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