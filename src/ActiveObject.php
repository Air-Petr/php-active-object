<?php

namespace AirPetr;

class ActiveObject
{
    /**
     * @var array
     */
    private array $commands = [];

    /**
     * @param Command $c
     * @return void
     */
    public function addCommand(Command $c): void
    {
        $this->commands[] = $c;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        while (!empty($this->commands)) {
            $command = array_shift($this->commands);
            $command->execute();
        }
    }
}