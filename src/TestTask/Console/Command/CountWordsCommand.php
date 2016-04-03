<?php

namespace TestTask\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CountWords
 * @package TestTask\Console\Command
 */
class CountWordsCommand extends AbstractTextCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('text:countWords')
            ->setDescription('Counts the words in the given file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument("file");

        $wordCount = $this->countWords($file);

        $output->writeln("Text in file '$file' contains $wordCount words!");
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function countWords($file)
    {
        $fileContent = $this->readFileContent($file);

        return str_word_count($fileContent);
    }
}