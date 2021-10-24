<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Template\DumpTemplate;
use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\DumpTemplate
 */
class DumpTemplateTest extends TestCase
{
    use ProphecyTrait;

    public function testWrite(): void
    {
        /** @var Writer|ObjectProphecy $writer */
        $writer = $this->prophesize(Writer::class);

        $destination = 'dest';
        $content = 'txt';
        $writer->dump($destination, $content)->shouldBeCalled();
        $sut = new DumpTemplate($destination, $content);
        $sut->write($writer->reveal());
    }
}
