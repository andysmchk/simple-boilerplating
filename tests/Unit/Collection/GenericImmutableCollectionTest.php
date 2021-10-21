<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Collection;

use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase;
use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;

class GenericImmutableCollectionTest extends TestCase
{
    use ProphecyTrait;

    /** @var GenericImmutableCollection */
    private $stub;

    public function setUp(): void
    {
        $this->stub = new class extends GenericImmutableCollection {
            public function add(int ...$value): self
            {
                return $this->merge($value, new static());
            }
        };
    }

    public function testCollectionKeepValues(): void
    {
        $values = [1, 2, 3, 4, 5, 6];
        $new = $this->stub->add(...$values);

        self::assertSame($values, iterator_to_array($new));
    }

    public function testCollectionIsImmutable(): void
    {
        $this->stub->add(1);

        self::assertSame([], iterator_to_array($this->stub));
    }

    public function testCollectionConstruct(): void
    {
        $values = [1, 2, 3, 4, 5, 6];

        $stub = new class(...$values) extends GenericImmutableCollection {
            public function __construct(int ...$value)
            {
                $this->merge($value, $this);
            }
        };

        self::assertSame($values, iterator_to_array($stub));
    }
}
