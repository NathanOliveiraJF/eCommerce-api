<?php

namespace Commerce\Logger\System;

use Psr\Log\LoggerInterface;

interface SystemLoggerInterface extends LoggerInterface
{
    CONST PATH = __DIR__ . '../../../../logs/system.log';
}