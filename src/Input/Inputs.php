<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;

/**
 * @extends GenericImmutableCollection<Input>
 */
class Inputs extends GenericImmutableCollection
{
    public function add(Input ...$input): self
    {
        return $this->merge($input, new self());
    }
}