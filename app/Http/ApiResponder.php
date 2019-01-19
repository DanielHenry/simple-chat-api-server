<?php

namespace App\Http;

trait ApiResponder
{
    protected $responseFormat = [
        'responseCode' => NULL,
        'message' => NULL,
        'errors' => NULL,
        'data' => NULL
    ]; 
    
    protected function success($message = 'Process Success!', $data = NULL) {
        return response()->json(array_merge($this->responseFormat, [
            'responseCode' => 200,
            'message' => $message,
            'data' => $data,
        ]));
    }

    protected function failure($errors = []) {
        return response()->json(array_merge($this->responseFormat, [
            'responseCode' => 400,
            'message' => 'Something went wrong. Try again!',
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ]));
    }

    protected function unauthorized() {
        return response()->json(array_merge($this->responseFormat, [
            'responseCode' => 401,
            'message' => 'Something went wrong. Try again!',
            'errors' => [
                'Not authorized!',
            ],
        ]));
    }

    protected function notFound($errors = ['Data not found!']) {
        return response()->json(array_merge($this->responseFormat, [
            'responseCode' => 404,
            'message' => 'Something went wrong. Try again!',
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ]));
    }    

    protected function invalidParameters($errors = [])
    {
        return response()->json(array_merge($this->responseFormat, [
            'responseCode' => 422,
            'message' => 'Something went wrong. Try again!',
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ]));
    }

    protected function customResponse($responseCode = 200, $message = '', $errors = NULL, $data = NULL)
    {
        return response()->json(array_merge($this->responseFormat, [
            'responseCode' => $responseCode,
            'message' => $message,
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            'data' => $data,
        ]));
    }
}