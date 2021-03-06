<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\MessageMail;
use App\Serializers\MessageSerializer;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Info(title="Message API", version="1.0")
 */
class MessageController extends Controller
{
    private $serializer;
    private $service;

    public function __construct(MessageSerializer $serializer, MessageService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }

    /**
     *  @OA\Post(
     *      path="/api/v1/message",
     *      summary="Отправка сообщения на фиксированный email адрес",
     *      @OA\Response(
     *          response="201",
     *          description="Успешная отправка сообщения",
     *      ),
     *      @OA\Response(
     *          response="208",
     *          description="Слишком частая отправка сообщений",
     *      )
     *  )
     */

    public function sendMessage(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        if ($this->service->checkForSpam($request)) {
            return $this->service->jsonResponse(
                $this->serializer->jsonErrorMessage('You are sending messages too often, please try again later.'),
                Response::HTTP_ALREADY_REPORTED
            );
        }

        $token = $this->service->getToken();

        $message = $this->service->saveMessageToDB($request, $token);

        $jsonResponse = $this->service->jsonResponse(
            $this->serializer->jsonMessage($message, $message->id),
            Response::HTTP_CREATED
        );

        $this->service->setCookie($jsonResponse, $token);

        Mail::queue(new MessageMail($message));

        return $jsonResponse;
    }
}
