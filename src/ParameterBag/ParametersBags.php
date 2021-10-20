<?php

namespace Rewsam\SimpleBoilerplating\ParameterBag;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

class ParametersBags extends GenericCollection
{
    public function add(ParametersBag ...$bag): void
    {
        $this->merge($bag);
    }

    public function toSingle(): ParametersBag
    {
        $bag = new DefaultParametersBag();

        foreach ($this->getIterator() as $item) {
            $bag->merge($item);
        }

        return $bag;
    }
}