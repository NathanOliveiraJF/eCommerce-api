<?php

namespace Commerce\Category\Http\Controllers;

interface ControllerInterface
{
    public function sendResponse(string $message, mixed $data,string $statusCode): void;

    public function sendError(string $errorMessage, string $statusCode): void;

}