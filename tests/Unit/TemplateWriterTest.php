<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\TemplateWriter;
use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateWriter
 */
class TemplateWriterTest extends TestCase
{
    use ProphecyTrait;

    protected ObjectProphecy $writer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->writer = $this->prophesize(Writer::class);
    }

    public function testWrite(): void
    {
        $writer = $this->writer->reveal();
        $sut = new TemplateWriter($writer);
        $template = $this->prophesize(Template::class);
        $template->write($writer)->shouldBeCalledOnce();
        $sut->write($template->reveal());
    }
}
