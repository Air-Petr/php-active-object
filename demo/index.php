<?php

require __DIR__ . '/../vendor/autoload.php';

use AirPetr\ActiveObject;
use AirPetr\Command;
use AirPetr\DelayedTyper;
use AirPetr\SleepCommand;

$stopCommand = new class implements Command {
    public function execute()
    {
        DelayedTyper::stopAll();
    }
};

$engine = new ActiveObject();
$engine->addCommand(new DelayedTyper(1, '1', $engine));
$engine->addCommand(new DelayedTyper(3, '3', $engine));
$engine->addCommand(new DelayedTyper(5, '5', $engine));
$engine->addCommand(new DelayedTyper(7, '7', $engine));
$engine->addCommand(new SleepCommand(20, $engine, $stopCommand));
$engine->run();

echo "\n";
die();
