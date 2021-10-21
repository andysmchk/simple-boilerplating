<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Collector\ArrayInputParameterCollectorStrategy;
use Rewsam\SimpleBoilerplating\Collector\ConsoleInputParameterCollectorStrategy;
use Rewsam\SimpleBoilerplating\Collector\InputParameterCollector;
use Rewsam\SimpleBoilerplating\Collector\InputParameterCollectorStrategy;
use Rewsam\SimpleBoilerplating\Collector\ReactorInputParameterCollectorDecorator;
use Rewsam\SimpleBoilerplating\Collector\StrategyInputParameterCollector;
use Rewsam\SimpleBoilerplating\Input\Input;
use Rewsam\SimpleBoilerplating\Input\InputOperator;
use Rewsam\SimpleBoilerplating\Input\InputReactor;
use Rewsam\SimpleBoilerplating\Input\InputReactorComposite;
use Rewsam\SimpleBoilerplating\Input\Inputs;
use Rewsam\SimpleBoilerplating\Render\MustacheRenderAdapter;
use Rewsam\SimpleBoilerplating\Render\RenderAdapter;
use Rewsam\SimpleBoilerplating\Template\FromDefinitionsTemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilder;
use Rewsam\SimpleBoilerplating\Template\TemplateBuilderComposite;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilder;
use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsBuilderComposite;
use Rewsam\SimpleBoilerplating\Template\TemplateFactory;
use Rewsam\SimpleBoilerplating\Template\TemplateTypeFactoryRegistry;
use Rewsam\SimpleBoilerplating\Writer\ConsoleOutputWriterDecorator;
use Rewsam\SimpleBoilerplating\Writer\DefaultWriter;
use Rewsam\SimpleBoilerplating\Writer\Writer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TemplatingBuilder
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions
     */
    private $definitions;
    /**
     * @var Inputs
     */
    private $parameters;
    /**
     * @var InputReactor
     */
    private $reactor;
    /**
     * @var Writer
     */
    private $writer;
    /**
     * @var RenderAdapter
     */
    private $driver;
    /**
     * @var TemplateTypeFactoryRegistry
     */
    private $templateTypeFactoryRegistry;
    /**
     * @var TemplateBuilderComposite
     */
    private $builderComposite;
    /**
     * @var TemplateDefinitionsBuilder
     */
    private $templateDefinitionsBuilder;
    /**
     * @var array
     */
    private $params = [];
    /**
     * @var bool
     */
    private $dryMode = false;
    /**
     * @var bool
     */
    private $allowOverride = true;
    /**
     * @var string
     */
    private $templatesPath = '';
    /**
     * @var string
     */
    private $writerBasePath = '';

    public function __construct()
    {
        $this->definitions = new TemplateDefinitions();
        $this->parameters = Inputs::create();
        $this->reactor = new InputReactorComposite();
        $this->builderComposite = new TemplateBuilderComposite();
        $this->templateDefinitionsBuilder = new TemplateDefinitionsBuilderComposite();
    }

    public function setTemplatesBasePath(string $templatesPath): self
    {
        $this->templatesPath = $templatesPath;

        return $this;
    }

    public function setWriterBasePath(string $writerBasePath): self
    {
        $this->writerBasePath = $writerBasePath;

        return $this;
    }

    public function addTemplateBuilder(TemplateBuilder $builder): self
    {
        $this->builderComposite->add($builder);

        return $this;
    }

    public function addTemplateDefinitionsBuilder(TemplateDefinitionsBuilder $builder): self
    {
        $this->templateDefinitionsBuilder->addBuilder($builder);

        return $this;
    }

    public function setTemplateTypeFactoryRegistry(TemplateTypeFactoryRegistry $templateTypeFactoryRegistry): self
    {
        $this->templateTypeFactoryRegistry = $templateTypeFactoryRegistry;

        return $this;
    }

    public function setDryMode(bool $dryMode): self
    {
        $this->dryMode = $dryMode;

        return $this;
    }

    public function setAllowOverride(bool $allowOverride): self
    {
        $this->allowOverride = $allowOverride;

        return $this;
    }

    public function addTemplateDefinitions(TemplateDefinitions $definitions): self
    {
        $this->definitions->mergeCollection($definitions);

        return $this;
    }

    public function addInputOperator(InputOperator $inputOperator): self
    {
        $this->parameters = $this->parameters->add(new Input($inputOperator, $inputOperator));

        return $this;
    }

    public function addInputReactor(InputReactor $reactor): self
    {
        $this->reactor->add($reactor);

        return $this;
    }

    public function setConsoleInputOutput(InputInterface $input, OutputInterface $output): self
    {
        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    public function addInputParams(array $params): self
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    public function setDriver(RenderAdapter $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function setValidator(ValidatorInterface $validator): self
    {
       $this->validator = $validator;

       return $this;
    }

    public function setWriter(Writer $param): self
    {
        $this->writer = $param;

        return $this;
    }

    public function getTemplating(): Templating
    {
        return new Templating(
            $this->getCollector(),
            $this->getTemplateWriter(),
            $this->getTemplateBuilder()
        );
    }

    private function getTemplateWriter(): TemplateWriter
    {
        return new TemplateWriter($this->getWriter());
    }

    private function getCollector(): InputParameterCollector
    {
        return new ReactorInputParameterCollectorDecorator(
            new StrategyInputParameterCollector($this->getCollectorStrategy(), $this->getParameters()),
            $this->getReactor()
        );
    }

    private function getTemplateBuilder(): TemplateBuilder
    {
        $factory = new TemplateFactory($this->getDriver(), $this->getTemplateTypeFactoryRegistry());
        $definitionsBuilder = new FromDefinitionsTemplateBuilder($factory, $this->getDefinitions());
        $this->builderComposite->add($definitionsBuilder);

        return $this->builderComposite;
    }

    private function getCollectorStrategy(): InputParameterCollectorStrategy
    {
        if ($this->input && $this->output) {
            $validator = $this->getValidator();

            return new ConsoleInputParameterCollectorStrategy($this->input, $this->output, $validator);
        }

        return new ArrayInputParameterCollectorStrategy($this->params);
    }

    private function getWriter(): Writer
    {
        $writer = $this->writer ?? DefaultWriter::createWithLocalFilesystem($this->writerBasePath, $this->dryMode, $this->allowOverride);

        if ($this->output) {
            $writer = new ConsoleOutputWriterDecorator($writer, $this->output);
        }

        return $writer;
    }

    private function getTemplateTypeFactoryRegistry(): TemplateTypeFactoryRegistry
    {
        return $this->templateTypeFactoryRegistry ?? new TemplateTypeFactoryRegistry();
    }

    private function getDriver(): RenderAdapter
    {
        return $this->driver ?? new MustacheRenderAdapter($this->templatesPath);
    }

    private function getDefinitions(): TemplateDefinitions
    {
        $new = new TemplateDefinitions();
        $new->mergeCollection($this->definitions);
        $new->mergeCollection($this->templateDefinitionsBuilder->build());

        return $new;
    }

    private function getReactor(): InputReactor
    {
        return $this->reactor;
    }

    private function getParameters(): Inputs
    {
        return $this->parameters;
    }

    private function getValidator(): ValidatorInterface
    {
        return $this->validator ?? Validation::createValidator();
    }
}