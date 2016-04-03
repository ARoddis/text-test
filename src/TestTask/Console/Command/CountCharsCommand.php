<?php

namespace TestTask\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CountCharsCommand
 * @package TestTask\Console\Command
 */
class CountCharsCommand extends AbstractTextCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('text:countChars')
            ->setDescription('Counts the chars in the given file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument("file");

        $letterCount = $this->countLetters($file);

        foreach ($letterCount as $key => $value) {
            $output->writeln(chr($key) . " occurs (char: $key) " . $value . " x");
        }
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function countLetters($file){
        $content = strtolower(preg_replace("#[^\\w]#", "", $this->readFileContent($file)));

        return count_chars($content, 1);
    }
}