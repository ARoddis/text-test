<?php


namespace TestTask\Console\Command\Exception;

use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Class TextFileIsNotWritableException
 * @package TestTask\Console\Command\Exception
 */
class TextFileIsNotWritableException extends InvalidArgumentException
{
    /**
     * @param $filePath
     */
    public function __constructor($filePath){
        $this->message = "The file '$filePath' is not writable for the command!";
    }
}