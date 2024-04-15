<?php

namespace Commerce\Logger\System;

interface SystemLoggerInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function execute(string $message): void;
}