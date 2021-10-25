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
            new TemplateDefinition('as78daf', 'sad3', 'ad644545'),
            new TemplateDefinition('as3daf', 'sad83', 'ad4545'),
            new TemplateDefinition('as4daf', 'sad43', 'ad455645'),
        ];

        $sut->add(...$values);
        self::assertSame($values, iterator_to_array($sut));
    }

    public function testMergeCollection(): void
    {
        $sut = new TemplateDefinitions();

        $values = [
            new TemplateDefinition('as3daf', 's5ad3', 'ad42545'),
            new TemplateDefinition('asd435af', '45sad3', 'ad44545'),
            new TemplateDefinition('as5daf', '5sad3', 'ad45545'),
        ];

        $sut->add(...$values);

        $merged = new TemplateDefinitions();
        $merged->mergeCollection($sut);

        self::assertSame($values, iterator_to_array($merged));
    }
}
