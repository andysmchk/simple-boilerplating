<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\TemplateDefinition;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;

/**
 * @covers \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions
 */
class TemplateDefinitionsTest extends TestCase
{
    use ProphecyTrait;

    public function testAdd(): void
    {
        $sut = new TemplateDefinitions();

        $values = [
            $this->prophesize(TemplateDefinition::class)->reveal(),
            $this->prophesize(TemplateDefinition::class)->reveal(),
            $this->prophesize(TemplateDefinition::class)->reveal(),
        ];

        $sut->add(...$values);
        self::assertSame($values, iterator_to_array($sut));
    }

    public function testMergeCollection(): void
    {
        $sut = new TemplateDefinitions();

        $values = [
            $this->prophesize(TemplateDefinition::class)->reveal(),
            $this->prophesize(TemplateDefinition::class)->reveal(),
            $this->prophesize(TemplateDefinition::class)->reveal(),
        ];

        $sut->add(...$values);

        $merged = new TemplateDefinitions();
        $merged->mergeCollection($sut);

        self::assertSame($values, iterator_to_array($merged));
    }
}
