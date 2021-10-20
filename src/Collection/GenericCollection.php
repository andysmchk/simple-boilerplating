<?php

namespace Rewsam\SimpleBoilerplating\Collection;

use Iterator;

/**
 * @template T
 */
abstract class GenericCollection implements Collection
{
    /** @var T[] */
    private $values = [];

    /** @param T[] $values */
    final protected function merge(array $values): void
    {
        $this->values = array_merge($this->values, $values);
    }

    /** @return Iterator|T[] */
    final public function getIterator(): Iterator
    {
        return new \ArrayIterator($this->values);
    }
}