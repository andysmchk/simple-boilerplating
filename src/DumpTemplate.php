<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Writer\Writer;

class DumpTemplate extends AbstractTemplate
{
    public const TYPE = 'dump';

    public function write(Writer $writer): void
    {
        $writer->dump($this->destination, $this->content);
    }
}
