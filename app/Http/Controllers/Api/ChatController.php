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
            $payload = $request->isJson() ? $request->json()->all() : [];
            $rules = [
                'messageText' => 'required|string|max:255',
            ];
            $validation = $this->customValidation($payload, $rules);
            if ($validation !== TRUE) {
                $response = $validation;
                return $response;
            }
            $message = new Message;
            $message->text = $payload['messageText'];
            $message->save();
            return $this->success('Message has been saved!');
        } catch (\Exception $e) {
            return $this->failure();
        }
    }

    public function getMessages(Request $request)
    {
        try {
            $payload = $request->isJson() ? $request->json()->all() : [];
            $rules = [
                'take' => 'integer|max:10',
                'skip' => 'integer|max:10',
                'desc' => 'boolean',
            ];
            $validation = $this->customValidation($payload, $rules);
            if ($validation !== TRUE) {
                $response = $validation;
                return $response;
            }
            $limit = (isset($payload['take']) && $payload['take'] >= 0) ? intval($payload['take']) : 10;
            $offset = ($payload['skip'] && $payload['skip'] >= 0) ? intval($payload['skip']) : 0;
            $isDesc = isset($payload['desc']) ? $payload['desc'] : FALSE;
            if ($isDesc) {
                $messages = Message::orderBy('id', 'desc')->take($limit)->skip($offset)->get();
            } else {
                $messages = Message::take($limit)->skip($offset)->get();
            }
            return $this->success('Messages has been taken!', $messages);
        } catch (\Exception $e) {
            return $this->failure();
        }
    }
}
