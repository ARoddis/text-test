<?php

namespace TestTask\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CountWordOccurrenceCommand
 * @package TestTask\Console\Command
 */
class CountWordOccurrenceCommand extends AbstractTextCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('text:countWordOccurrences')
            ->setDescription('Counts the occurrences of words in the given file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument("file");

        $wordOccurrences = $this->countWordOccurrences($file);

        $output->writeln("Text in file '$file' contains following occurrences of words:");
        $output->writeln("");

        foreach ($wordOccurrences as $word => $occurrence) {
            $output->writeln("$word => " . $occurrence);
        }
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function countWordOccurrences($file)
    {
        $fileContent = $this->readFileContent($file);

        $wordOccurrences = array_count_values(
            str_word_count($fileContent, 2)
        );

        asort($wordOccurrences);

        return $wordOccurrences;
    }
}