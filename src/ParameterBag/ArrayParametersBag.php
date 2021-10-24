<?php

namespace Rewsam\SimpleBoilerplating\ParameterBag;

class ArrayParametersBag implements ParametersBag
{
    private $store = [];

    /** @param $value mixed */
    public function set(string $key, $value): void
    {
        $this->store[$key] = $value;
    }

    public function all(): array
    {
        return $this->store;
    }

    /** @return mixed */
    public function get(string $key)
    {
        return $this->store[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->store);
    }

    public function merge(ParametersBag $bag): void
    {
        foreach ($bag->all() as $key => $value) {
            $this->set($key, $value);
        }
    }
}