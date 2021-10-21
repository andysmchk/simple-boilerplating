<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collection;

use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase;
use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

class GenericCollectionTest extends TestCase
{
    use ProphecyTrait;

    /** @var GenericCollection */
    private $stub;

    public function setUp(): void
    {
        $this->stub = new class extends GenericCollection {
            public function add(int ...$value): void
            {
                $this->merge($value);
            }
        };
    }

    public function testCollectionKeepValues(): void
    {
        $values = [1, 2, 3, 4, 5, 6];
        $this->stub->add(...$values);

        self::assertSame($values, iterator_to_array($this->stub));
    }
}
