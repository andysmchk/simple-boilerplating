<?php

namespace Rewsam\SimpleBoilerplating\Input;

final class Input
{
    /**
     * @var InputRequirement
     */
    private $inputRequirement;
    /**
     * @var InputBagFactory
     */
    private $inputBagFactory;

    public function __construct(InputRequirement $inputRequirement, InputBagFactory $inputBagFactory)
    {
        $this->inputRequirement = $inputRequirement;
        $this->inputBagFactory = $inputBagFactory;
    }

    public function getInputRequirement(): InputRequirement
    {
        return $this->inputRequirement;
    }

    public function getInputBagFactory(): InputBagFactory
    {
        return $this->inputBagFactory;
    }
}