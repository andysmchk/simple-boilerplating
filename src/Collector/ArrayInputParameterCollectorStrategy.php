<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

final class ArrayInputParameterCollectorStrategy implements InputParameterCollectorStrategy
{
    /**
     * @var array
     */
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function fetch(InputParameterDefinition $definition): string
    {
        return (string) ($this->params[$definition->getKey()] ?? '');
    }
}
