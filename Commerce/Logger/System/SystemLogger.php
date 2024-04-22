<?php

namespace Commerce\Logger\System;

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
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Warning));
        $this->logger->error($message);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Emergency));
        $this->logger->error($message);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function alert($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Alert));
        $this->logger->error($message);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Critical));
        $this->logger->error($message);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function error($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Error));
        $this->logger->error($message);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function warning($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Warning));
        $this->logger->error($message);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function notice($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Notice));
        $this->logger->error($message);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function info($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Info));
        $this->logger->error($message);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function debug($message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH, Level::Debug));
        $this->logger->error($message);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = array()): void
    {
        $this->logger->pushHandler(new StreamHandler(self::PATH), $level);
        $this->logger->log($level, $message, $context);
    }
}