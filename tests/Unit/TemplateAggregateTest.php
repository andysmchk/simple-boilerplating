<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase;
use Rewsam\SimpleBoilerplating\Template;
use Rewsam\SimpleBoilerplating\TemplateAggregate;
use Rewsam\SimpleBoilerplating\Writer\Writer;

class TemplateAggregateTest extends TestCase
{
    use ProphecyTrait;

    public function testWriterIsCalledOnEachTemplate(): void
    {
        $writer = $this->prophesize(Writer::class)->reveal();

        $aggregate = new TemplateAggregate();

        for ($i=0; $i<5; $i++) {
            $template = $this->prophesize(Template::class);
            $template->write($writer)->shouldBeCalledOnce();
            $aggregate->add($template->reveal());
        }

        $aggregate->write($writer);
    }
}
