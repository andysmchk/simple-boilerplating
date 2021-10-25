<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

use InvalidArgumentException;

class DefaultTemplateTypeFactoryRegistry implements TemplateTypeFactoryRegistry
{
    /** @var TemplateTypeFactory[]  */
    private $registry = [];

    public function __construct()
    {
        $this->register(AppendTemplate::TYPE, new class implements TemplateTypeFactory {
            public function create(string $destinations, string $content): Template
            {
                return new AppendTemplate($destinations, $content);
            }
        });

        $this->register(DumpTemplate::TYPE, new class implements TemplateTypeFactory {
            public function create(string $destinations, string $content): Template
            {
                return new DumpTemplate($destinations, $content);
            }
        });
    }

    public function get(string $type): TemplateTypeFactory
    {
        if (isset($this->registry[$type])) {
            return $this->registry[$type];
        }

        throw new InvalidArgumentException('Template type is not supported');
    }

    public function register(string $type, TemplateTypeFactory $factory): void
    {
        $this->registry[$type] = $factory;
    }
}