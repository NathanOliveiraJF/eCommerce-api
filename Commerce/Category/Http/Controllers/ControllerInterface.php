<?php

namespace Commerce\Category\Http\Controllers;

interface ControllerInterface
{
    public function sendResponse(string $message, string $statusCode, mixed $data): void;

    public function sendError(string $errorMessage, string $statusCode): void;

}