<?php

namespace Rewsam\SimpleBoilerplating;

use Traversable;

class InputParameterDefinitions implements \IteratorAggregate
{
    /**
     * @var InputParameterDefinition[]
     */
    private $definitions = [];

    public function add(InputParameterDefinition $definition): void
    {
        $this->definitions[] = $definition;
    }

    /**
     * @return InputParameterDefinition[]|Traversable
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->definitions);
    }
}