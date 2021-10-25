<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\Constraints;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SymfonySimpleValidatorAdapter implements SimpleValidatorAdapter
{
    public function __construct(private ValidatorInterface $validator) {}

    public function validate(mixed $value, Constraints $constraints): SymfonySimpleValidationResult
    {
        return new SymfonySimpleValidationResult($this->validator->validate($value, iterator_to_array($constraints)));
    }
}