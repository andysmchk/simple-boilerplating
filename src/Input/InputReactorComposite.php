<?php

namespace Rewsam\SimpleBoilerplating\Input;

use Rewsam\SimpleBoilerplating\ParametersBag;

class InputReactorComposite implements InputReactor
{
    /** @var InputReactor[]  */
    private $reactors = [];

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