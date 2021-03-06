<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Render;

use Mustache_Engine;
use Mustache_Loader;
use Mustache_Loader_FilesystemLoader;
use Mustache_Loader_StringLoader;
use Mustache_Logger_StreamLogger;
use Rewsam\SimpleBoilerplating\ParameterBag\ParametersBag;

final class MustacheRenderAdapter implements RenderAdapter
{
    public function __construct(private string $baseDir) {}

    public function renderTemplate(string $path, ParametersBag $parametersBag): string
    {
        $tpl = $this->getEngine(new Mustache_Loader_FilesystemLoader($this->baseDir))->loadTemplate($path);

        return $tpl->render($parametersBag->all());
    }

    public function renderString(string $template, ParametersBag $parametersBag): string
    {
        $mustache = $this->getEngine(new Mustache_Loader_StringLoader());

        return $mustache->render($template, $parametersBag->all());
    }

    private function getEngine(Mustache_Loader $loader): Mustache_Engine
    {
        return new Mustache_Engine(array(
            'loader' => $loader,
            'escape' => fn($value): string => htmlspecialchars($value, ENT_COMPAT, 'UTF-8'),
            'charset' => 'ISO-8859-1',
            'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
            'strict_callables' => true,
            'pragmas' => [Mustache_Engine::PRAGMA_FILTERS],
        ));
    }
}