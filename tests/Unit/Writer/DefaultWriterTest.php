<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Writer;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Rewsam\SimpleBoilerplating\Writer\DefaultWriter;
use Rewsam\SimpleBoilerplating\Writer\WriterAdapter;

/** @covers \Rewsam\SimpleBoilerplating\Writer\DefaultWriter  */
class DefaultWriterTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy $filesystem;

    public function setUp(): void
    {
        $this->filesystem = $this->prophesize(WriterAdapter::class);
    }

    /** @dataProvider filesProviderWithOverride */
    public function testAppendNonDryFileDoesNotExists(string $destination, bool $override): void
    {
        $this->filesystem->exists($destination)->shouldBeCalledOnce()->willReturn(false);
        $this->filesystem->readFrom(Argument::any())->shouldNotBeCalled();
        $this->filesystem->writeTo(Argument::any(), Argument::any())->shouldNotBeCalled();
        $writer = new DefaultWriter($this->filesystem->reveal(), false, $override);
        $writer->append($destination, ' foobar');
    }

    /** @dataProvider filesProviderWithOverride */
    public function testAppendNonDryFileExists(string $destination, bool $override): void
    {
        $expectedContent = 'Lorem ipsum foobar';
        $existingContent = 'Lorem ipsum';
        $this->filesystem->exists($destination)->shouldBeCalledOnce()->willReturn(true);
        $this->filesystem->readFrom($destination)->shouldBeCalledOnce()->willReturn($existingContent);
        $this->filesystem->writeTo($destination, $expectedContent)->shouldBeCalledOnce();
        $writer = new DefaultWriter($this->filesystem->reveal(), false, $override);
        $writer->append($destination, ' foobar');
    }

    /** @dataProvider filesProvider */
    public function testDumpNonDryNonOverrideFileExists(string $destination): void
    {
        $this->filesystem->exists($destination)->shouldBeCalledOnce()->willReturn(true);
        $this->filesystem->writeTo(Argument::any(), Argument::any())->shouldNotBeCalled();
        $writer = new DefaultWriter($this->filesystem->reveal(), false, false);
        $writer->dump($destination, 'foobar');
    }

    /** @dataProvider filesProvider */
    public function testDumpNonDryNonOverrideFileDoesNotExists(string $destination): void
    {
        $expectedContent = 'Lorem ipsum';
        $this->filesystem->exists($destination)->shouldBeCalledOnce()->willReturn(false);
        $this->filesystem->writeTo($destination, $expectedContent)->shouldBeCalledOnce();
        $writer = new DefaultWriter($this->filesystem->reveal(), false, false);
        $writer->dump($destination, $expectedContent);
    }

    /** @dataProvider filesProvider */
    public function testDumpNonDryOverride(string $destination): void
    {
        $expectedContent = 'Lorem ipsum';
        $this->filesystem->exists($destination)->shouldNotBeCalled();
        $this->filesystem->writeTo($destination, $expectedContent)->shouldBeCalledOnce();
        $writer = new DefaultWriter($this->filesystem->reveal(), false, true);
        $writer->dump($destination, $expectedContent);
    }

    /** @dataProvider overrideOptionsProvider */
    public function testDumpDry(bool $override): void
    {
        $this->filesystem->exists(Argument::any())->shouldNotBeCalled();
        $this->filesystem->writeTo(Argument::any(), Argument::any())->shouldNotBeCalled();
        $writer = new DefaultWriter($this->filesystem->reveal(), true, $override);
        $writer->dump('path', 'foobar');
    }

    /** @dataProvider overrideOptionsProvider */
    public function testAppendDry(bool $override): void
    {
        $this->filesystem->exists(Argument::any())->shouldNotBeCalled();
        $this->filesystem->readFrom(Argument::any())->shouldNotBeCalled();
        $this->filesystem->writeTo(Argument::any(), Argument::any())->shouldNotBeCalled();
        $writer = new DefaultWriter($this->filesystem->reveal(), true, $override);
        $writer->append('path', 'foobar');
    }

    /** @dataProvider dryOverrideProvider */
    public function testExists(bool $dry, bool $override): void
    {
        $destination = 'destination';
        $this->filesystem->exists($destination)->shouldBeCalledOnce();

        $writer = new DefaultWriter($this->filesystem->reveal(), $dry, $override);
        $writer->exists($destination);
    }

    public function dryOverrideProvider(): array
    {
        return [
            'Dry and Override' => [true, true],
            'Non Dry and Override' => [false, true],
            'Dry and Non Override' => [true, false],
            'Non Dry and Non Override' => [false, false],
        ];
    }

    public function overrideOptionsProvider(): array
    {
        return [
            'Override' => [true],
            'Non Override' => [false],
        ];
    }

    public function filesProvider(): array
    {
        return [
            ['destination/file.yml'],
            ['destination/deeper/file.yml'],
            ['destination'],
            ['destination/deep'],
        ];
    }

    public function filesProviderWithOverride(): iterable
    {
        foreach ($this->filesProvider() as $item) {
            $result = $item;
            $result[] = true;
            yield $result;

            $result = $item;
            $result[] = false;
            yield $result;
        }
    }
}

