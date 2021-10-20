<?php

namespace Rewsam\SimpleBoilerplating;

use Iterator;
use IteratorAggregate;

/**
 * @template T
 */
abstract class GenericCollection implements IteratorAggregate
{
    /** @var T[] */
    private $values = [];

    /** @param T[] $values */
    final protected function merge(array $values): void
    {
        $this->values = array_merge($this->values, $values);
    }

    /** @param GenericCollection<T> $collection */
    final protected function mergeCollection(GenericCollection $collection): void
    {
        $this->merge($collection->toArray());
    }

    /** @return T[] */
    final public function toArray(): array
    {
        return $this->values;
    }

    /** @return Iterator|T[] */
    final public function getIterator(): Iterator
    {
        return new \ArrayIterator($this->values);
    }
}