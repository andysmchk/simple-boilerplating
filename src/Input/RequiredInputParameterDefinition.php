<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

final class RequiredInputParameterDefinition implements InputParameterDefinition
{
    private Constraints $constraints;

    public function __construct(
        private string $key,
        private string $description,
        Constraint ...$constraints
    ) {
        $this->constraints = new Constraints(new NotBlank(), new NotNull(), ...$constraints);
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
        return $this->constraints;
    }
}