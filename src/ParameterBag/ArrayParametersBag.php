<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\ParameterBag;

final class ArrayParametersBag implements ParametersBag
{
    private array $store = [];

    public function set(string $key, mixed $value): void
    {
        $this->store[$key] = $value;
    }

    public function all(): array
    {
        return $this->store;
    }

    public function get(string $key): mixed
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