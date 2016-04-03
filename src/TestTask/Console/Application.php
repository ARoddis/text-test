<?php

namespace TestTask\Console;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;


/**
 * Class Application
 * @package TestTask\Console
 */
class Application extends \Symfony\Component\Console\Application
{
    /**
     *
     */
    const COMMAND_PATH = "./src/TestTask/Console/Command";

    /**
     *
     */
    const COMMAND_NAMESPACE = 'TestTask\Console\Command';

    /**
     * @return $this
     */
    public function registerCommands()
    {
        $commandFiles = $this->findCommandFiles();

        foreach ($commandFiles as $commandFile) {
            /**
             * @var $commandFile SplFileInfo
             */
            $commandClassName = $this->getClassName($commandFile);

            $this->add(new $commandClassName());
        }

        return $this;
    }

    /**
     * @return Finder
     */
    protected function findCommandFiles()
    {
        return (
        new Finder()
        )->files()
            ->in(self::COMMAND_PATH)
            ->depth(0)
            ->notName("Abstract*.php")
            ->name("*.php");
    }

    /**
     * @param SplFileInfo $commandFile
     * @return string
     */
    protected function getClassName(SplFileInfo $commandFile)
    {
        return self::COMMAND_NAMESPACE . '\\' . str_replace(".php", "", $commandFile->getBasename());
    }
}