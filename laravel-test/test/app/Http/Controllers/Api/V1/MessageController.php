<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Entity\Message;
use App\Http\Controllers\Controller;
use App\Mail\MessageMail;
use App\Serializers\MessageSerializer;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class MessageController extends Controller
{
    private $serializer;
    private $service;

    public function __construct(MessageSerializer $serializer, MessageService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }

    public function sendMessage(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::make([
            'message' => $request['message'],
            'remote_ip' => $request->getClientIp(),
            'token' => Uuid::uuid4(),
            'expired' => $this->service->getExpiredDate(),
        ]);

        $cookie = Cookie::make('client_token', 'MyValue', 60);
        $response = response()->json(
            $this->serializer->jsonMessage($message, $message->id),
            Response::HTTP_CREATED);
        $response->headers->setCookie($cookie);

        Mail::send(new MessageMail($message));

        $message->saveOrFail();

        return $response;
    }
}
