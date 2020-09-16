<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Entity\Message;
use App\Services\MessageService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SaveMessageToDBTest extends TestCase
{
    use DatabaseTransactions;

    public function testSaveMessageToDB(): void
    {
        $service = new MessageService();

        $request = new Request();
        $request->headers->set('Accept', 'application/json');
        $text = $request['message'] = 'Message';

        $message = $service->saveMessageToDB($request, $token = $service->getToken());

        self::assertNotEmpty($message);

        self::assertEquals($token, $message->token);
        self::assertEquals($text, $message->message);
        self::assertTrue($message->expired_date instanceof Carbon);
    }
}
