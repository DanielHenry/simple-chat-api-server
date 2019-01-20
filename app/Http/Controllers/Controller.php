<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Validator;
use App\Http\ApiResponder;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponder;

    protected function customValidation($payload = [], $rules = [], $messages = [])
    {
        $validator = Validator::make($payload, $rules, $messages);
        if ($validator->fails()) {
            return $this->invalidParameters($validator->errors()->all());
        } else {
            return TRUE;
        }
    }

    protected function guardWithValidation($payload = [], $rules = [], $messages = [], $callback)
    {
        $validator = Validator::make($payload, $rules, $messages);
        if ($validator->fails()) {
            return $this->invalidParameters($validator->errors()->all());
        } else {
            return $callback();
        }
    }
}
