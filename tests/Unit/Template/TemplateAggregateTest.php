<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Template\Template;
use Rewsam\SimpleBoilerplating\Template\TemplateAggregate;
use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\TemplateAggregate
 */
class TemplateAggregateTest extends TestCase
{
    use ProphecyTrait;

    public function testWrite(): void
    {
        $sut = new TemplateAggregate();
        $writer = $this->prophesize(Writer::class)->reveal();

        $template = $this->prophesize(Template::class);
        $template->write($writer)->shouldBeCalledOnce();
        $sut->add($template->reveal());

        $template = $this->prophesize(Template::class);
        $template->write($writer)->shouldBeCalledOnce();
        $sut->add($template->reveal());

        $sut->write($writer);
    }
}
