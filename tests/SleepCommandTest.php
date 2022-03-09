<?php

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
     * @return \AirPetr\ActiveObject
     */
    protected function prepareEngine(int $sleepTime): \AirPetr\ActiveObject
    {
        $engine = new \AirPetr\ActiveObject();
        $sleepCommand = new \AirPetr\SleepCommand($sleepTime, $engine, $this->getEchoCommand());
        $engine->addCommand($sleepCommand);
        return $engine;
    }

    /**
     * @return \AirPetr\Command
     */
    private function getEchoCommand(): \AirPetr\Command
    {
        return new class implements \AirPetr\Command {
            public function execute()
            {
                echo 'Hello World';
            }
        };
    }
}
