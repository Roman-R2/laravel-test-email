<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class MessageService
{
    public function getExpiredDate()
    {
        return Carbon::now()->addMinutes(env('NEXT_DISPATCH_AFTER'));
    }

    public function saveMessageToDB(Request $request, $token)
    {
        $message = Message::make([
            'message' => $request['message'],
            'remote_ip' => $request->getClientIp(),
            'token' => $token,
            'expired_date' => $this->getExpiredDate(),
        ]);

        $message->saveOrFail();

        return $message;
    }

    public function setCookie(JsonResponse $response, $value)
    {
        $cookie = Cookie::make('client_token', $value, 60);
        $response->headers->setCookie($cookie);

        return $response;
    }

    public function getToken()
    {
        return Uuid::uuid4();
    }

}
