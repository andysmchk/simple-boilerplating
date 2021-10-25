<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Input\InputOperator;
use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\Render\RenderAdapter;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateTypeFactoryRegistry;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilder;
use Rewsam\SimpleBoilerplating\TemplatingBuilder;
use Rewsam\SimpleBoilerplating\Writer\Writer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplatingBuilder
 */
class TemplatingBuilderTest extends TestCase
{
    use ProphecyTrait;

    private TemplatingBuilder $sut;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new TemplatingBuilder();
        $this->sut->setWriter($this->prophesize(Writer::class)->reveal());
        $this->sut->setDriver($this->prophesize(RenderAdapter::class)->reveal());
    }

    public function testErrorMinimalConfiguration(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $sut = new TemplatingBuilder();
        $sut->getTemplating();
    }

    public function testValidMinimalConfiguration(): void
    {
        $this->expectNotToPerformAssertions();
        $this->sut->getTemplating();
    }

    public function testAddTemplateBuilder(): void
    {
        self::assertSame($this->sut, $this->sut->addTemplateBuilder($this->prophesize(TemplateBuilder::class)->reveal()));
    }

    public function testAddTemplateDefinitionsBuilder(): void
    {
        self::assertSame($this->sut, $this->sut->addTemplateDefinitionsBuilder($this->prophesize(TemplateDefinitionsBuilder::class)->reveal()));

    }

    public function testSetTemplateTypeFactoryRegistry(): void
    {
        self::assertSame($this->sut, $this->sut->setTemplateTypeFactoryRegistry($this->prophesize(TemplateTypeFactoryRegistry::class)->reveal()));

    }

    public function testSetDryMode(): void
    {
        self::assertSame($this->sut, $this->sut->setDryMode(true));

    }

    public function testSetAllowOverride(): void
    {
        self::assertSame($this->sut, $this->sut->setAllowOverride(false));

    }

    public function testAddTemplateDefinitions(): void
    {
        self::assertSame($this->sut, $this->sut->addTemplateDefinitions(new TemplateDefinitions()));

    }

    public function testAddInputOperator(): void
    {
        self::assertSame($this->sut, $this->sut->addInputOperator($this->prophesize(InputOperator::class)->reveal()));

    }

    public function testAddInputReactor(): void
    {
        self::assertSame($this->sut, $this->sut->addInputReactor($this->prophesize(InputReactor::class)->reveal()));

    }

    public function testSetConsoleInputOutput(): void
    {
        self::assertSame($this->sut, $this->sut->setConsoleInputOutput(
            $this->prophesize(InputInterface::class)->reveal(),
            $this->prophesize(OutputInterface::class)->reveal()
        ));
    }

    public function testAddInputParams(): void
    {
        self::assertSame($this->sut, $this->sut->addInputParams(['key' => 'val']));
    }

    public function testSetDriver(): void
    {
        self::assertSame($this->sut, $this->sut->setDriver($this->prophesize(RenderAdapter::class)->reveal()));

    }

    public function testSetValidator(): void
    {
        self::assertSame($this->sut, $this->sut->setValidator($this->prophesize(ValidatorInterface::class)->reveal()));

    }

    public function testSetWriter(): void
    {
        self::assertSame($this->sut, $this->sut->setWriter($this->prophesize(Writer::class)->reveal()));

    }

    public function testSetConsoleInputOutputAndValidator(): void
    {
        $this->sut->setConsoleInputOutput(
            $this->prophesize(InputInterface::class)->reveal(),
            $this->prophesize(OutputInterface::class)->reveal()
        );
        self::assertSame($this->sut, $this->sut->setValidator($this->prophesize(ValidatorInterface::class)->reveal()));
    }



}
