<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Symfony\Component\Validator\Constraint;

final class DefaultInputParameterDefinition implements InputParameterDefinition
{
    private Constraints $constraint;

    public function __construct(private string $key, private string $description, Constraint ...$constraint)
    {
        $this->constraint = new Constraints(...$constraint);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getConstraints(): Constraints
    {
        return $this->constraint;
    }
}