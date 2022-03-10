<?php

use AirPetr\ActiveObject;
use AirPetr\Command;
use AirPetr\DelayedTyper;
use PHPUnit\Framework\TestCase;

class DelayedTyperTest extends TestCase
{
    /**
     * @return void
     */
    public function testExecuteAndStop(): void
    {
        $activeObject = new ActiveObject();
        $activeObject->addCommand(new DelayedTyper(1, 't', $activeObject));
        $activeObject->addCommand($this->getStopCommand());
        $activeObject->run();
        $this->expectOutputString('tt');
    }

    /**
     * @return Command
     */
    private function getStopCommand(): Command
    {
        return new class implements Command {
            public function execute()
            {
                DelayedTyper::stopAll();
            }
        };
    }
}
