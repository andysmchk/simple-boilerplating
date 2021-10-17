<?php

namespace Rewsam\SimpleBoilerplating;

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
     * @var TemplateDefinitions
     */
    private $definitions;
    /**
     * @var InputParameterDefinitions
     */
    private $parameters;
    /**
     * @var Writer
     */
    private $writer;
    /**
     * @var RenderAdapter
     */
    private $driver;
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
    private $applicationBasePath = '';

    public function __construct()
    {
        $this->definitions = new TemplateDefinitions();
        $this->parameters = new InputParameterDefinitions();
    }

    public function setApplicationBasePath(string $applicationBasePath): self
    {
        $this->applicationBasePath = $applicationBasePath;

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
        /** @var TemplateDefinition $definition */
        foreach ($definitions as $definition) {
            $this->definitions->addTemplate($definition->getSourcePath(), $definition->getDestinationPath(), $definition->getMode());
        }

        return $this;
    }

    public function addInputParameterDefinitions(InputParameterDefinitions $parameters): self
    {
        foreach ($parameters as $parameter) {
            $this->parameters->add($parameter);
        }

        return $this;
    }

    public function setConsoleInputOutput(InputInterface $input, OutputInterface $output): self
    {
        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    public function setInputParams(array $params): self
    {
        $this->params = $params;

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

    public function addWriter(Writer $param): self
    {
        $this->writer = $param;

        return $this;
    }

    public function build(): Templating
    {
        return new Templating($this);
    }

    public function getCollectorStrategy(): InputParameterCollectorStrategy
    {
        if ($this->input && $this->output) {
            $validator = $this->getValidator();

            return new ConsoleInputParameterCollectorStrategy($this->input, $this->output, $validator);
        }

        return new ArrayInputParameterCollectorStrategy($this->params);
    }

    public function getWriter(): Writer
    {
        $writer = $this->writer ?? DefaultWriter::createWithLocalFilesystem($this->applicationBasePath, $this->dryMode, $this->allowOverride);

        if ($this->output) {
            $writer = new ConsoleOutputWriterDecorator($writer, $this->output);
        }

        return $writer;
    }

    public function getDriver(): RenderAdapter
    {
        return $this->driver ?? new MustacheRenderAdapter($this->applicationBasePath);
    }

    public function getDefinitions(): TemplateDefinitions
    {
        return $this->definitions;
    }

    public function getParameters(): InputParameterDefinitions
    {
        return $this->parameters;
    }

    private function getValidator(): ValidatorInterface
    {
        return $this->validator ?? Validation::createValidator();
    }
}