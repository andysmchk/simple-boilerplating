<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class SymfonySimpleValidationResult implements SimpleValidationResult
{
    /**
     * @param ConstraintViolationListInterface<ConstraintViolationInterface> $violationList
     */
    public function __construct(private ConstraintViolationListInterface $violationList) {}

    public function getMultilineMessage(): string
    {
        $error = '';

        foreach ($this->violationList as $violation) {
            $error .= $violation->getMessage()."\n";
        }

        return trim($error);
    }
}