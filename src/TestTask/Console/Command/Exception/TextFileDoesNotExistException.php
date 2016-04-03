<?php


namespace TestTask\Console\Command\Exception;

use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Class TextFileDoesNotExistException
 * @package TestTask\Console\Command\Exception
 */
class TextFileDoesNotExistException extends InvalidArgumentException
{
    /**
     * @param $filePath
     */
    public function __constructor($filePath){
        $this->message = "File with path '$filePath' does not exist!";
    }
}