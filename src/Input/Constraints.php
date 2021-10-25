<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericImmutableCollection;
use Symfony\Component\Validator\Constraint;

/**
 * @extends GenericImmutableCollection<Constraint>
 */
final class Constraints extends GenericImmutableCollection
{
    public function __construct(Constraint ...$constraint)
    {
        $this->merge($constraint, $this);
    }
}