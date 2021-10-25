<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

final class InputReactorComposite implements InputReactor
{
    /** @var InputReactor[]  */
    private array $reactors = [];

    public function add(InputReactor $inputReactor): void
    {
        $this->reactors[] = $inputReactor;
    }

    public function react(ParametersBag $bag): void
    {
        foreach ($this->reactors as $reactor) {
            if ($reactor->supports($bag)) {
                $reactor->react($bag);
            }
        }
    }

    public function supports(ParametersBag $bag): bool
    {
        foreach ($this->reactors as $reactor) {
            if ($reactor->supports($bag)) {
                return true;
            }
        }

        return false;
    }
}