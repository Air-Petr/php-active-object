<?php

namespace AirPetr;

class SleepCommand implements Command
{
    private int $sleepTime;
    private ActiveObject $engine;
    private Command $wakeupCommand;
    private bool $isStarted = false;
    private int $startTime;

    /**
     * @param int $seconds
     * @param ActiveObject $engine
     * @param Command $wakeupCommand
     */
    public function __construct(int $seconds, ActiveObject $engine, Command $wakeupCommand)
    {
        $this->sleepTime = $seconds;
        $this->engine = $engine;
        $this->wakeupCommand = $wakeupCommand;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $currentTime = time();

        if (!$this->isStarted) {
            $this->isStarted = true;
            $this->startTime = $currentTime;
            $this->wait();
        } elseif (($currentTime - $this->startTime) < $this->sleepTime) {
            $this->wait();
        } else {
            $this->engine->addCommand($this->wakeupCommand);
        }
    }

    /**
     * @return void
     */
    protected function wait(): void
    {
        $this->engine->addCommand($this);
    }
}