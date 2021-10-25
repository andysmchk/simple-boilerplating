<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

final class Input
{
    public function __construct(
        private InputRequirement $inputRequirement,
        private InputBagFactory $inputBagFactory
    ) {}

    public function getInputRequirement(): InputRequirement
    {
        return $this->inputRequirement;
    }

    public function getInputBagFactory(): InputBagFactory
    {
        return $this->inputBagFactory;
    }
}