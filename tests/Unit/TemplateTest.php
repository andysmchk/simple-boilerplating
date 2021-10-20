<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase;
use Rewsam\SimpleBoilerplating\Template\AppendTemplate;
use Rewsam\SimpleBoilerplating\Template\DumpTemplate;
use Rewsam\SimpleBoilerplating\Writer\Writer;

class TemplateTest extends TestCase
{
    use ProphecyTrait;

    public function testDumpTemplate(): void
    {
        $content = 'foo';
        $destination = 'bar';
        $template = new DumpTemplate($destination, $content);
        $writer = $this->prophesize(Writer::class);
        $writer->dump($destination, $content)->shouldBeCalledOnce();
        $template->write($writer->reveal());
    }

    public function testAppendTemplate(): void
    {
        $content = 'foo';
        $destination = 'bar';
        $template = new AppendTemplate($destination, $content);
        $writer = $this->prophesize(Writer::class);
        $writer->append($destination, $content)->shouldBeCalledOnce();
        $template->write($writer->reveal());
    }
}
