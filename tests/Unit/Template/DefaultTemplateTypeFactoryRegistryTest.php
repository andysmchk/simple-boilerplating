<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Template;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Template\AppendTemplate;
use Rewsam\SimpleBoilerplating\Template\DumpTemplate;
use Rewsam\SimpleBoilerplating\Template\TemplateTypeFactory;
use Rewsam\SimpleBoilerplating\Template\DefaultTemplateTypeFactoryRegistry;

/**
 * @covers \Rewsam\SimpleBoilerplating\Template\DefaultTemplateTypeFactoryRegistry
 */
class DefaultTemplateTypeFactoryRegistryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerTemplates
     */
    public function testGet(string $type, string $class): void
    {
        $sut = new DefaultTemplateTypeFactoryRegistry();

        $factory = $sut->get($type);
        $template = $factory->create('test', 'txt');

        self::assertInstanceOf($class, $template);
    }


    public function testGetInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $sut = new DefaultTemplateTypeFactoryRegistry();
        $sut->get('test');
    }

    public function testRegister(): void
    {
        $sut = new DefaultTemplateTypeFactoryRegistry();
        $typeFactory = $this->prophesize(TemplateTypeFactory::class)->reveal();

        $sut->register('test', $typeFactory);

        self::assertSame($typeFactory, $sut->get('test'));
    }

    public function providerTemplates(): array
    {
        return [
            [AppendTemplate::TYPE, AppendTemplate::class],
            [DumpTemplate::TYPE, DumpTemplate::class],
        ];
    }
}
