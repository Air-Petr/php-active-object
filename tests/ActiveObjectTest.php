<?php

use AirPetr\ActiveObject;
use AirPetr\Command;
use PHPUnit\Framework\TestCase;

class ActiveObjectTest extends TestCase
{
    /**
     * @var bool
     */
    public static $commandExecuted = false;

    /**
     * @return void
     */
    public function testRun()
    {
        $activeObject = new ActiveObject();
        $activeObject->addCommand($this->getTestCommand());
        $activeObject->run();

        self::assertTrue(self::$commandExecuted);
    }

    /**
     * @return Command
     */
    private function getTestCommand(): Command
    {
        return new class implements Command {
            public function execute()
            {
                ActiveObjectTest::$commandExecuted = true;
            }
        };
    }
}
