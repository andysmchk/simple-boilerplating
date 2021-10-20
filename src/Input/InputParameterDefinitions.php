<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\GenericCollection;

/**
 * @extends GenericCollection<InputParameterDefinition>
 */
class InputParameterDefinitions extends GenericCollection
{
    public function add(InputParameterDefinition ...$definitions): void
    {
        $this->merge($definitions);
    }

    public function addCollection(InputParameterDefinitions $definitions): void
    {
        $this->mergeCollection($definitions);
    }
}