<?php

namespace Rewsam\SimpleBoilerplating\Collection;

use Iterator;

/**
 * @template T
 */
abstract class GenericImmutableCollection implements Collection
{
    /** @var T[] */
    private $values = [];

    /**
     * @param T[] $values
     * @param GenericImmutableCollection<T> $new
     * @return GenericImmutableCollection<T>
     */
    final protected function merge(array $values, GenericImmutableCollection $new): self
    {
        $new->values = array_merge($this->values, $values);

        return $new;
    }

    /** @return Iterator|T[] */
    final public function getIterator(): Iterator
    {
        return new \ArrayIterator($this->values);
    }
}