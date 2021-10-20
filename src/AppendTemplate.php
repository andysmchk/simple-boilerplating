<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Writer\Writer;

class AppendTemplate extends AbstractTemplate
{
    public const TYPE = 'append';

    public function write(Writer $writer): void
    {
        $writer->append($this->destination, $this->content);
    }
}
