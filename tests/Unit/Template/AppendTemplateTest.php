<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Template\AppendTemplate;
use Rewsam\SimpleBoilerplating\Writer\Writer;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\AppendTemplate
 */
class AppendTemplateTest extends TestCase
{
    use ProphecyTrait;

    public function testWrite(): void
    {
        /** @var Writer|ObjectProphecy $writer */
        $writer = $this->prophesize(Writer::class);

        $destination = 'dest';
        $content = 'txt';
        $writer->append($destination, $content)->shouldBeCalled();
        $sut = new AppendTemplate($destination, $content);
        $sut->write($writer->reveal());
    }
}
