<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use IteratorAggregate;
use Symfony\Component\Validator\Constraint;
use Traversable;

/**
 * @implements IteratorAggregate<int, Constraint>
 */
final class Constraints implements IteratorAggregate
{
    /** @var Constraint[] */
    private array $values;

    public function __construct(Constraint ...$constraint)
    {
        $this->values = $constraint;
    }

    /** @return Traversable<int, Constraint> */
    public function getIterator(): Traversable
    {
        yield from $this->values;
    }
}