<?php

namespace Rewsam\SimpleBoilerplating\Collector;

use Symfony\Component\Console\Question\Question;

/**
 * @codeCoverageIgnore
 */
interface QuestionHelperAdapter
{
    /** @return mixed answer */
    public function ask(Question $question);
}