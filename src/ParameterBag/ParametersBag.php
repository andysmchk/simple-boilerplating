<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\ParameterBag;

/**
 * @codeCoverageIgnore
 */
interface ParametersBag
{
    public function set(string $key, mixed $value): void;

    /**
     * @return array<string, mixed>
     */
    public function all(): array;

    public function get(string $key): mixed;

    public function has(string $key): bool;

    public function merge(ParametersBag $bag): void;
}