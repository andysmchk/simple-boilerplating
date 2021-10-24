<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Writer;

use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Writer\LocalFilesystemWriterAdapter;

/**
 * @covers \Rewsam\SimpleBoilerplating\Writer\LocalFilesystemWriterAdapter
 */
class LocalFilesystemWriterAdapterTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var Filesystem|ObjectProphecy
     */
    protected $filesystem;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->filesystem = $this->prophesize(Filesystem::class);
    }

    public function testExists(): void
    {
        $destination = 'dst';
        $this->filesystem->fileExists($destination)->willReturn(true)->shouldBeCalledOnce();
        $sut = new LocalFilesystemWriterAdapter($this->filesystem->reveal());
        self::assertTrue($sut->exists($destination));
    }

    public function testWriteTo(): void
    {
        $destination = 'dst';
        $content = 'lorem';
        $this->filesystem->write($destination, $content)->shouldBeCalledOnce();
        $sut = new LocalFilesystemWriterAdapter($this->filesystem->reveal());
        $sut->writeTo($destination, $content);    }

    public function testReadFrom(): void
    {
        $destination = 'dst';
        $content = 'lorem';
        $this->filesystem->read($destination)->willReturn($content)->shouldBeCalledOnce();
        $sut = new LocalFilesystemWriterAdapter($this->filesystem->reveal());
        self::assertSame($content, $sut->readFrom($destination));
    }
}
