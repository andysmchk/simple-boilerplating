<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\Constraints;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SymfonySimpleValidatorAdapter implements SimpleValidatorAdapter
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /** @param mixed $value */
    public function validate($value, Constraints $constraints): SimpleValidationResult
    {
        return new SymfonySimpleValidationResult($this->validator->validate($value, iterator_to_array($constraints)));
    }
}