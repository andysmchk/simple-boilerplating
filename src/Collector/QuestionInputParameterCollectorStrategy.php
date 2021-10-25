<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;
use RuntimeException;
use Symfony\Component\Console\Question\Question;

final class QuestionInputParameterCollectorStrategy implements InputParameterCollectorStrategy
{
    public function __construct(
        private QuestionHelperAdapter $questionHelper,
        private SimpleValidatorAdapter $validation
    ) {}

    public function fetch(InputParameterDefinition $definition): string
    {
        $question = new Question(sprintf('Please define %s: ', $definition->getDescription()));
        $question->setValidator(function ($value) use ($definition) {
            $violations = $this->validation->validate($value, $definition->getConstraints());

            if (($error = $violations->getMultilineMessage()) !== '' && ($error = $violations->getMultilineMessage()) !== '0') {
                throw new RuntimeException($error);
            }

            return $value;
        });

        return $this->questionHelper->ask($question);
    }
}