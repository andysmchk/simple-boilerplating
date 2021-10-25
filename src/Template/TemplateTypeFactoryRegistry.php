<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

interface TemplateTypeFactoryRegistry
{
    public function get(string $type): TemplateTypeFactory;

    public function register(string $type, TemplateTypeFactory $factory): void;
}