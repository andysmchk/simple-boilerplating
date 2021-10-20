<?php

namespace Rewsam\SimpleBoilerplating\ParameterBag;

interface ParametersBag
{
    /** @param $value mixed */
    public function set(string $key, $value): void;

    public function all(): array;

    /** @return mixed */
    public function get(string $key);

    public function has(string $key): bool;

    public function merge(ParametersBag $bag): void;
}