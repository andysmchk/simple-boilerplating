<?php

namespace Rewsam\SimpleBoilerplating\Collection;

use Iterator;

/**
 * @template T
 */
abstract class GenericImmutableCollection implements Collection
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

    /** @return Iterator|T[] */
    final public function getIterator(): Iterator
    {
        return new \ArrayIterator($this->values);
    }
}