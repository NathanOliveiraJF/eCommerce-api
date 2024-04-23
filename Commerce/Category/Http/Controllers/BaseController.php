<?php

namespace Commerce\Category\Http\Controllers;

abstract class BaseController implements ControllerInterface
{
    /**
     * @param string $message
     * @param mixed $data
     * @param string $statusCode
     * @return void
     */
    public function sendResponse(string $message, mixed $data, string $statusCode): void
    {
        $response = [
            'statusCode' => $statusCode,
            'data' => $data,
            'message' => $message
        ];
        response()->httpCode($statusCode)->json($response);
    }

    /**
     * @param string $errorMessage
     * @param string $statusCode
     * @return void
     */
    public function sendError(string $errorMessage, string $statusCode): void
    {
        $response = [
            'statusCode' => $statusCode,
            'message' => $errorMessage
        ];
        response()->httpCode($statusCode)->json($response);
    }

}