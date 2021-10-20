<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class RequiredInputParameterDefinition extends DefaultInputParameterDefinition
{
    public function __construct(string $key, string $description)
    {
        parent::__construct($key, $description, new NotBlank(), new NotNull());
    }
}