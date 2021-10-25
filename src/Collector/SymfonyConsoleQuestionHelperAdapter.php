<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class SymfonyConsoleQuestionHelperAdapter implements QuestionHelperAdapter
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

    public function __construct(QuestionHelper $questionHelper, InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->questionHelper = $questionHelper;
    }

    /**
     * @param Question $question
     * @return mixed answer
     */
    public function ask(Question $question)
    {
        return $this->questionHelper->ask($this->input, $this->output, $question);
    }
}