<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\TemplateDefinition;

final class TemplateDefinitionsTreeBuilder implements TemplateDefinitionsBuilder
{
    /** @param array<int, array> $config */
    public function __construct(private array $config) {}

    public function build(): TemplateDefinitions
    {
        $definitions = new TemplateDefinitions();
        $reader = new TemplateDefinitionsConfigTreeReader($this->config);

        foreach ($reader->read() as $definition) {
            $definitionFactory = new BasePathTemplateDefinitionFactory(
                $definition->getSourceBasePath(),
                $definition->getDestinationBasePath()
            );

            foreach ($definition->files() as $file) {
                $definitions->add(
                    $definitionFactory->make(
                        $file->getSource(),
                        $file->getDestination(),
                        $file->getMode()
                    ),
                );
            }
        }

        return $definitions;
    }
}