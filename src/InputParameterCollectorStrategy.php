<?php

namespace Rewsam\SimpleBoilerplating;

interface InputParameterCollectorStrategy
{
    public function fetch(InputParameterDefinition $definition): string;
}