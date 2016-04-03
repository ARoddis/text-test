<?php


namespace TestTask\Console\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use TestTask\Console\Command\Exception\TextFileDoesNotExistException;
use TestTask\Console\Command\Exception\TextFileIsNotWritableException;

/**
 * Class AbstractTextCommand
 * @package TestTask\Console\Command
 */
class AbstractTextCommand extends Command
{

    /**
     * @param $filePath
     * @return string
     */
    protected function readFileContent($filePath){
        if(!file_exists($filePath)){
            throw new TextFileDoesNotExistException($filePath);
        }

        if(!is_writable($filePath)){
            throw new TextFileIsNotWritableException($filePath);
        }

        return file_get_contents($filePath);
    }

    /**
     *
     */
    protected function configure()
    {
        $this->addArgument(
                'file',
                InputArgument::REQUIRED,
                'Which file to process'
            );
    }

}