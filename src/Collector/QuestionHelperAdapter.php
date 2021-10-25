<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Symfony\Component\Console\Question\Question;

/**
 * @codeCoverageIgnore
 */
interface QuestionHelperAdapter
{
    public function ask(Question $question): mixed;
}