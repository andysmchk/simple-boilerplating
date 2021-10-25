<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

/**
 * @extends GenericCollection<InputParameterDefinition>
 */
final class InputParameterDefinitions extends GenericCollection
{
    public function add(InputParameterDefinition ...$definitions): void
    {
        $this->merge($definitions);
    }
}