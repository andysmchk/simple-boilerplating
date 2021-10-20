<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;

/**
 * @extends GenericImmutableCollection<Input>
 */
final class Inputs extends GenericImmutableCollection
{
    public static function create(Input ...$input): Inputs
    {
        return (new Inputs())->merge($input);
    }

    public function add(Input ...$input): Inputs
    {
        return $this->merge($input);
    }
}