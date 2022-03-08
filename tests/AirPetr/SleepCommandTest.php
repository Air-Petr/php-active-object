<?php

namespace AirPetr;

use PHPUnit\Framework\TestCase;

class SleepCommandTest extends TestCase
{
    public function testCommand()
    {
        $engine = new ActiveObject();
        $impliedSleepTime = 2;
        $sleepCommand = new SleepCommand($impliedSleepTime, $engine, $this->getEchoCommand());
        $engine->addCommand($sleepCommand);

        $startTime = time();
        $engine->run();
        $stopTime = time();

        $actualSleepTime = $stopTime - $startTime;

        $this->assertGreaterThanOrEqual($impliedSleepTime, $actualSleepTime);
        $this->expectOutputString('Hello World');
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
