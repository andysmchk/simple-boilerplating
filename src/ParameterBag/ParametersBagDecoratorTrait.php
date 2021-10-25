<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\ParameterBag;

trait ParametersBagDecoratorTrait
{
    /**
     * @var ParametersBag
     */
    private $bag;

    public function set(string $key, $value): void
    {
        $this->bag->set($key, $value);
    }

    public function all(): array
    {
        return $this->bag->all();
    }

    public function get(string $key)
    {
        return $this->bag->get($key);
    }

    public function has(string $key): bool
    {
        return $this->bag->has($key);
    }

    public function merge(ParametersBag $bag): void
    {
        $this->bag->merge($bag);
    }

    private function setBag(ParametersBag $bag): void
    {
        $this->bag = $bag;
    }
}