<?php

namespace Rewsam\SimpleBoilerplating;

use Symfony\Component\Validator\Constraint;

class InputParameterDefinition
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $description;
    /**
     * @var Constraint
     */
    private $constraint;

    public function __construct(string $key, string $description, Constraint ...$constraint)
    {
        $this->key = $key;
        $this->description = $description;
        $this->constraint = $constraint;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getConstraints(): array
    {
        return $this->constraint;
    }
}