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
                'take' => 'required|integer|max:10',
                'skip' => 'required|integer|max:10',
                'desc' => 'required|boolean',
            ];
            $validation = $this->customValidation($payload, $rules);
            if ($validation !== TRUE) {
                $response = $validation;
                return $response;
            }
            $limit = ($payload['take'] >= 0) ? intval($payload['take']) : 10;
            $offset = ($payload['skip'] >= 0) ? intval($payload['skip']) : 0;
            $isDesc = $payload['desc'];
            if ($isDesc) {
                $messages = Message::select('text as messageText', 'delivered_at as timeDelivered')->orderBy('id', 'desc')->take($limit)->skip($offset)->get();
            } else {
                $messages = Message::select('text as messageText', 'delivered_at as timeDelivered')->take($limit)->skip($offset)->get();
            }
            return $this->success('Messages has been taken!', $messages);
        } catch (\Exception $e) {
            return $this->failure();
        }
    }
}
