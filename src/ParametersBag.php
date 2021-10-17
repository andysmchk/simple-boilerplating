<?php

namespace Rewsam\SimpleBoilerplating;

use InvalidArgumentException;

final class ParametersBag
{
    private $store = [];

    /** @param $value int|float|string|bool */
    public function add(string $key, $value): void
    {
        if (!is_scalar($value)) {
            throw new InvalidArgumentException('Value is not a scalar, something went wrong');
        }

        $this->store[$key] = $value;
    }

    public function getAll(): array
    {
        return $this->store;
    }
}