<?php

namespace Rewsam\SimpleBoilerplating;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ConsoleInputParameterCollectorStrategy implements InputParameterCollectorStrategy
{
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var QuestionHelper
     */
    private $questionHelper;
    /**
     * @var ValidatorInterface
     */
    private $validation;

    public function __construct(InputInterface $input, OutputInterface $output, ValidatorInterface $validation)
    {
        $this->input = $input;
        $this->output = $output;
        $this->questionHelper = new QuestionHelper();
        $this->validation = $validation;
    }

    public function fetch(InputParameterDefinition $definition): string
    {
        return $this->ask($definition);
    }

    private function ask(InputParameterDefinition $definition): string
    {
        $question = new Question(sprintf('Please define %s: ', $definition->getDescription()));

        $value = $this->questionHelper->ask($this->input, $this->output, $question);
        $validationResult = $this->validation->validate($value, iterator_to_array($definition->getConstraints()));

        if (count($validationResult) === 0) {
            return (string) $value;
        }

        /** @var ConstraintViolationInterface $item */
        foreach ($validationResult as $item) {
            $this->output->writeln('<error>' . $item->getMessage() . '</error>');
        }

        return $this->ask($definition);
    }
}