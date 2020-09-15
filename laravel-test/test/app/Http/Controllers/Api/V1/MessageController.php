<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Entity\Message;
use App\Http\Controllers\Controller;
use App\Mail\MessageMail;
use App\Serializers\MessageSerializer;
use App\Services\MessageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
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

        if ($this->service->checkToken($request)) {
            return response()->json(
                $this->serializer->jsonErrorMessage('You are sending messages too often, please try again later.'),
                Response::HTTP_ALREADY_REPORTED);
        }

       $token = $this->service->getToken();

        $message = $this->service->saveMessageToDB($request, $token);

        $jsonResponse = response()->json(
            $this->serializer->jsonMessage($message, $message->id),
            Response::HTTP_CREATED);

        $this->service->setCookie($jsonResponse, $token);

        Mail::send(new MessageMail($message));

        return $jsonResponse;
    }
}
