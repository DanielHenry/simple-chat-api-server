<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            $validation = $this->customValidation($request, $rules);
            if ($validation !== TRUE) {
                $response = $validation;
                return $response;
            }
            $message = new Message;
            $message->text = $request->messageText;
            $message->save();
            return $this->success('Message has been saved!');
        } catch (\Exception $e) {
            return $this->failure();
        }
    }

    public function getMessages(Request $request)
    {
        try {
            $validation = $this->customValidation($request, $rules);
            if ($validation !== TRUE) {
                $response = $validation;
                return $response;
            }
            $limit = $request->take;
            $offset = $request->skip;
            $messages = Message::orderBy('id', 'desc')->take($limit)->skip($offset)->get();
            return $this->success('Messages has been taken!', $messages);
        } catch (\Exception $e) {
            return $this->failure();
        }
    }
}
