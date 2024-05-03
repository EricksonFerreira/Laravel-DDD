<?php

namespace App\Application\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ValidationException extends Exception
{
    protected $errors;

    public function __construct($errors, $message = 'Validation errors', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'data' => $this->errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
