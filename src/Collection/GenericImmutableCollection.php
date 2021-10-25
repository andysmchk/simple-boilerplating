<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collection;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

/**
 * @template T
 */
abstract class GenericImmutableCollection implements IteratorAggregate
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
    final public function getIterator()
    {
        return new ArrayIterator($this->values);
    }
}