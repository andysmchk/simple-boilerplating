<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

/**
 * @extends GenericCollection<InputParameterDefinition>
 */
class InputParameterDefinitions extends GenericCollection
{
    public function add(InputParameterDefinition ...$definitions): void
    {
        $this->merge($definitions);
    }
}