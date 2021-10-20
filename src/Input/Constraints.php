<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;
use Symfony\Component\Validator\Constraint;

/**
 * @extends \Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection<Constraint>
 */
class Constraints extends GenericImmutableCollection
{
    public static function create(Constraint ...$input): Constraints
    {
        return (new Constraints())->merge($input);
    }
}