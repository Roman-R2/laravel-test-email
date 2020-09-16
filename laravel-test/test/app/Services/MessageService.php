<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;
use Eloquent;
use Webmozart\Assert\Assert;

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
            'remote_ip' => $request->getClientIp() ? $request->getClientIp() : '127.0.0.1',
            'token' => $token,
            'expired_date' => $this->getExpiredDate(),
        ]);

        $message->saveOrFail();

        return $message;
    }

    public function setCookie(JsonResponse $response, $value)
    {
        Assert::uuid($value);

        $cookie = Cookie::make('client_token', $value, 60);
        $response->headers->setCookie($cookie);

        return $response;
    }

    public function getToken()
    {
        return Uuid::uuid4();
    }

    public function checkToken(Request $request): bool
    {
        $requestToken = $request->cookie('client_token');

        $query = Message::
        where('token', '=', $requestToken)->
        where('expired_date', '>=', Carbon::now())->
        get();

        return $query->count() ? true : false;
    }

    public function checkIP(Request $request): bool
    {
        $query = Message::
        where('remote_ip', '=', $request->getClientIp())->
        where('expired_date', '>=', Carbon::now())->
        get();

        return $query->count() ? true : false;
    }

    public function checkForSpam(Request $request): bool
    {
        $isSpam = false;

        !$this->checkToken($request) ?: $isSpam = true;
        !$this->checkIP($request) ?: $isSpam = true;

        return $isSpam;
    }

    public function jsonResponse($messageArray, $status) {
        return response()->json($messageArray, $status);
    }

}
