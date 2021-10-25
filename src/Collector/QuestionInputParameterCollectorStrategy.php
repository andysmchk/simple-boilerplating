<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Collector;

use Rewsam\SimpleBoilerplating\Input\InputParameterDefinition;
use RuntimeException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class QuestionInputParameterCollectorStrategy implements InputParameterCollectorStrategy
{
    /**
     * @var QuestionHelper
     */
    private $questionHelper;
    /**
     * @var ValidatorInterface
     */
    private $validation;

    public function __construct(QuestionHelperAdapter $questionHelper, SimpleValidatorAdapter $validation)
    {
        $this->validation = $validation;
        $this->questionHelper = $questionHelper;
    }

    public function fetch(InputParameterDefinition $definition): string
    {
        $question = new Question(sprintf('Please define %s: ', $definition->getDescription()));
        $question->setValidator(function ($value) use ($definition) {
            $violations = $this->validation->validate($value, $definition->getConstraints());

            if ($error = $violations->getMultilineMessage()) {
                throw new RuntimeException($error);
            }

            return $value;
        });

        return $this->questionHelper->ask($question);
    }
}