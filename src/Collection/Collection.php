<?php

namespace Rewsam\SimpleBoilerplating\Collection;

use Iterator;
use IteratorAggregate;

/**
 * @template T
 * @codeCoverageIgnore
 */
interface Collection extends IteratorAggregate
{
    /** @return Iterator|T[] */
    public function getIterator(): Iterator;
}