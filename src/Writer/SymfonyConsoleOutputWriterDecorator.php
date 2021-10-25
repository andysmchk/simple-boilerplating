<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Writer;

use Symfony\Component\Console\Output\OutputInterface;

final class SymfonyConsoleOutputWriterDecorator implements Writer
{
    public function __construct(
        private Writer $subject,
        private OutputInterface $output
    ) {}

    public function exists(string $destination): bool
    {
        return $this->subject->exists($destination);
    }

    public function dump(string $destination, string $content): void
    {
        $this->subject->dump($destination, $content);

        $this->output->writeln('<info>Added new file: ' . $destination . '</info>');
        $this->output->writeln('<info>New File Content: ' . $content . '</info>', OutputInterface::OUTPUT_RAW | OutputInterface::VERBOSITY_VERY_VERBOSE);
    }

    public function append(string $destination, string $content): void
    {
        $this->subject->append($destination, $content);

        $this->output->writeln('<comment>Updated file: ' . $destination . '</comment>');
        $this->output->writeln('<comment>Updated content: ' . $content . '</comment>', OutputInterface::OUTPUT_RAW | OutputInterface::VERBOSITY_VERY_VERBOSE);
    }
}