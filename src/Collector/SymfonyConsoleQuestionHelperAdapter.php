<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class SymfonyConsoleQuestionHelperAdapter implements QuestionHelperAdapter
{
    public function __construct(
        private QuestionHelper  $questionHelper,
        private InputInterface  $input,
        private OutputInterface $output
    ) {}

    public function ask(Question $question): mixed
    {
        return $this->questionHelper->ask($this->input, $this->output, $question);
    }
}