<?php

namespace Rewsam\SimpleBoilerplating;

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