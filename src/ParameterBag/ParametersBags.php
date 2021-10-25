<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\ParameterBag;

use Rewsam\SimpleBoilerplating\Collection\GenericCollection;

/**
 * @extends ParametersBags<ParametersBag>
 */
final class ParametersBags extends GenericCollection
{
    public function add(ParametersBag ...$bag): void
    {
        $this->merge($bag);
    }

    public function toSingle(): ArrayParametersBag
    {
        $bag = new ArrayParametersBag();

        foreach ($this->getIterator() as $item) {
            $bag->merge($item);
        }

        return $bag;
    }
}