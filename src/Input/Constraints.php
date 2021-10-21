<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;
use Symfony\Component\Validator\Constraint;

/**
 * @extends GenericImmutableCollection
 */
class Constraints extends GenericImmutableCollection
{
    public function __construct(Constraint ...$constraint)
    {
        $this->merge($constraint, $this);
    }
}