<?php

namespace Modules\Logger\System;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class SystemLogger implements SystemLoggerInterface
{
    /**
     * @var Logger
     * */
    private LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $message
     * @return void
     */
    public function execute(string $message): void
    {
        $this->logger->pushHandler(new StreamHandler(__DIR__.'../../../../logs/system.log', Level::Warning));
        $this->logger->error($message);
    }
}