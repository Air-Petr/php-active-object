<?php

namespace AirPetr;

interface Command
{
    /**
     * @return mixed
     */
    public function execute();
}