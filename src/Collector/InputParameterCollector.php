<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBags;

/**
 * @codeCoverageIgnore
 */
interface InputParameterCollector
{
    public function collect(): ParametersBags;
}