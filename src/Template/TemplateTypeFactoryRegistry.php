<?php

namespace Rewsam\SimpleBoilerplating\Template;

interface TemplateTypeFactoryRegistry
{
    public function get(string $type): TemplateTypeFactory;

    public function register(string $type, TemplateTypeFactory $factory): void;
}