<?php

namespace AirPetr;

class DelayedTyper implements Command
{
    /**
     * @var int
     */
    private int $delay;

    /**
     * @var string
     */
    private string $char;

    /**
     * @var ActiveObject
     */
    private ActiveObject $engine;

    /**
     * @var bool
     */
    private static bool $stop = false;

    /**
     * @param int $delay
     * @param string $char
     * @param ActiveObject $engine
     */
    public function __construct(int $delay, string $char, ActiveObject $engine)
    {
        $this->delay = $delay;
        $this->char = $char;
        $this->engine = $engine;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        echo $this->char;

        if (!self::$stop) {
            $this->delayAndRepeat();   
        }
    }

    /**
     * @return void
     */
    public static function stopAll(): void
    {
        self::$stop = true;
    }

    /**
     * @return void
     */
    private function delayAndRepeat(): void
    {
        $this->engine->addCommand(new SleepCommand($this->delay, $this->engine, $this));
    }
}