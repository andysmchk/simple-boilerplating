<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Symfony\Component\Validator\Constraint;

final class DefaultInputParameterDefinition implements InputParameterDefinition
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
     * @var Constraints
     */
    private $constraint;

    public function __construct(string $key, string $description, Constraint ...$constraint)
    {
        $this->key = $key;
        $this->description = $description;
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