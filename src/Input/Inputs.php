<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<int, Input>
 */
final class Inputs implements IteratorAggregate
{
    /** @var Input[] */
    private array $values;

    public function __construct(Input ...$input)
    {
        $this->values = $input;
    }

    public function add(Input ...$input): self
    {
        return new self(...array_merge($this->values, $input));
    }

    /** @return Traversable<int, Input> */
    public function getIterator(): Traversable
    {
        yield from $this->values;
    }
}