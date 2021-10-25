<?php

namespace Rewsam\SimpleBoilerplating\Template;

use Rewsam\SimpleBoilerplating\Writer\Writer;

final class DumpTemplate extends AbstractTemplate
{
    public const TYPE = 'dump';

    public function write(Writer $writer): void
    {
        $writer->dump($this->destination, $this->content);
    }
}
