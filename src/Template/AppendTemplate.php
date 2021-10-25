<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Writer\Writer;

final class AppendTemplate extends AbstractTemplate
{
    public const TYPE = 'append';

    public function write(Writer $writer): void
    {
        $writer->append($this->destination, $this->content);
    }
}
