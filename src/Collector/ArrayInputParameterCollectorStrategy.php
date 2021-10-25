<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;

final class ArrayInputParameterCollectorStrategy implements InputParameterCollectorStrategy
{
    /**
     * @param array<mixed, mixed> $params
     */
    public function __construct(private array $params = []) {}

    public function fetch(InputParameterDefinition $definition): string
    {
        return (string) ($this->params[$definition->getKey()] ?? '');
    }
}
