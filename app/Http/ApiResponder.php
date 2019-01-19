<?php

namespace App\Http;

trait ApiResponder
{
    protected $responseFormat = [
        'response_code' => NULL,
        'message' => NULL,
        'errors' => NULL,
        'data' => NULL
    ]; 
    
    protected function success($message = 'Permintaan berhasil diproses.', $data = NULL) {
        return response()->json(array_merge($this->responseFormat, [
            'response_code' => 200,
            'message' => $message,
            'data' => $data,
        ]));
    }

    protected function failure($errors = ['Permintaan gagal diproses.']) {
        return response()->json(array_merge($this->responseFormat, [
            'response_code' => 400,
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ]));
    }

    protected function unauthorized() {
        return response()->json(array_merge($this->responseFormat, [
            'response_code' => 401,
            'errors' => [
                'Hak akses tidak tersedia.',
            ],
        ]));
    }

    protected function notFound($errors = ['Data tidak ditemukan.']) {
        return response()->json(array_merge($this->responseFormat, [
            'response_code' => 404,
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ]));
    }    

    protected function invalidParameters($errors = [])
    {
        return response()->json(array_merge($this->responseFormat, [
            'response_code' => 422,
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ]));
    }

    protected function customResponse($responseCode = 200, $message = '', $errors = NULL, $data = NULL)
    {
        return response()->json(array_merge($this->responseFormat, [
            'response_code' => $responseCode,
            'message' => $message,
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            'data' => $data,
        ]));
    }
}