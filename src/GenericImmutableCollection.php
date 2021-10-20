<?php

namespace Rewsam\SimpleBoilerplating;

use Iterator;
use IteratorAggregate;

/**
 * @template T
 */
abstract class GenericImmutableCollection implements IteratorAggregate
{
    /** @var T[] */
    private $values;

    /** @param T[] $values */
    final protected function __construct(...$values)
    {
        $this->values = $values;
    }

    /**
     * @param T[] $values
     * @return GenericImmutableCollection<T>
     */
    final protected function merge(array $values): GenericImmutableCollection
    {
        return new static(...array_merge($this->values, $values));
    }

    /**
     * @param GenericImmutableCollection<T> $collection
     * @return GenericImmutableCollection<T>
     */
    final protected function mergeCollection(GenericImmutableCollection $collection): GenericImmutableCollection
    {
        return $this->merge($collection->toArray());
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