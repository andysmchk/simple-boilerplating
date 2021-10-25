<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collection;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

/**
 * @template T
 */
abstract class GenericCollection implements IteratorAggregate
{
    /** @var T[] */
    private array $values = [];

    /** @param T[] $values */
    final protected function merge(array $values): void
    {
        $this->values = array_merge($this->values, $values);
    }

    /** @return Iterator|T[] */
    final public function getIterator(): Iterator
    {
        return new ArrayIterator($this->values);
    }
}