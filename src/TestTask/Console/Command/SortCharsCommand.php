<?php

namespace TestTask\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class SortCharsCommand
 * @package TestTask\Console\Command
 */
class SortCharsCommand extends AbstractTextCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('text:sortChars')
            ->addOption(
                'sort-direction',
                null,
                InputOption::VALUE_OPTIONAL,
                'In which direction should the chars be sorted?',
                "asc"
            )
            ->setDescription('Sorts the chars in the given file and outputs them sorted');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument("file");

        $sortingDirection = $input->getOption("sort-direction");

        $sortedChars = $this->sortChars($file, $sortingDirection);

        $output->writeln("Text in file '$file' as sorted string in direction '$sortingDirection':");
        $output->writeln($sortedChars);
    }

    /**
     * @param $file
     * @param $sortingDirection
     * @return string
     */
    protected function sortChars($file, $sortingDirection){

        $content = preg_replace("#[^\\w]#", "", $this->readFileContent($file));

        $chars = str_split($content);

        if($sortingDirection === "asc") {
            sort($chars);
        }else{
            rsort($chars);
        }

        return implode("", $chars);
    }
}