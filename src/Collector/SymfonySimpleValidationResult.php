<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class SymfonySimpleValidationResult implements SimpleValidationResult
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violationList;

    public function __construct(ConstraintViolationListInterface $violationList)
    {
        $this->violationList = $violationList;
    }

    public function getMultilineMessage(): string
    {
        $error = '';

        foreach ($this->violationList as $violation) {
            $error .= $violation->getMessage()."\n";
        }

        return trim($error);
    }
}