<?php

use AirPetr\ActiveObject;
use AirPetr\Command;
use AirPetr\SleepCommand;
use PHPUnit\Framework\TestCase;

class SleepCommandTest extends TestCase
{
    public function testCommand()
    {
        $impliedSleepTime = 2;
        $engine = $this->prepareEngine($impliedSleepTime);

        $startTime = time();
        $engine->run();
        $stopTime = time();

        $this->assertGreaterThanOrEqual($impliedSleepTime, $stopTime - $startTime);
        $this->expectOutputString('Hello World');
    }

    /**
     * @param int $sleepTime
     * @return ActiveObject
     */
    protected function prepareEngine(int $sleepTime): ActiveObject
    {
        $engine = new ActiveObject();
        $sleepCommand = new SleepCommand($sleepTime, $engine, $this->getEchoCommand());
        $engine->addCommand($sleepCommand);
        return $engine;
    }

    /**
     * @return Command
     */
    private function getEchoCommand(): Command
    {
        return new class implements Command {
            public function execute()
            {
                echo 'Hello World';
            }
        };
    }
}
