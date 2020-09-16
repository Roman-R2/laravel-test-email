<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Services\MessageService;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\Assert;

class GetTokenTest extends TestCase
{
    public function testNotUuidToken(): void
    {
        $service = new MessageService();

        $token = $service->getToken();

        self::assertNull(Assert::uuid($token));
    }
}
