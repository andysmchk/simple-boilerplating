<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Render;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Render\MustacheRenderAdapter;

/**
 * @covers \Rewsam\SimpleBoilerplating\Render\MustacheRenderAdapter
 */
class MustacheRenderAdapterTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var string
     */
    protected $baseDir;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->baseDir = '42';
    }

    public function test__construct(): void
    {
        $this->markTestIncomplete();
        $sut = new MustacheRenderAdapter($this->baseDir);
    }

    public function testRenderTemplate(): void
    {
        $this->markTestIncomplete();
        $sut = new MustacheRenderAdapter($this->baseDir);
    }

    public function testRenderString(): void
    {
        $this->markTestIncomplete();
        $sut = new MustacheRenderAdapter($this->baseDir);
    }
}
