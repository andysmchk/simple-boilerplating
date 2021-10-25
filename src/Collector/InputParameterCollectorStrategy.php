<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

/**
 * @codeCoverageIgnore
 */
interface InputParameterCollectorStrategy
{
    public function fetch(InputParameterDefinition $definition): string;
}