<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;

/**
 * @extends GenericImmutableCollection<Input>
 */
final class Inputs extends GenericImmutableCollection
{
    public function add(Input ...$input): self
    {
        return $this->merge($input, new self());
    }
}