<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

final class RequiredInputParameterDefinition implements InputParameterDefinition
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
    private $constraints;

    public function __construct(string $key, string $description, Constraint ...$constraints)
    {
        $this->key = $key;
        $this->description = $description;
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