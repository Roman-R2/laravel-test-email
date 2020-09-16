<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Services\MessageService;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class GetExpiredDataTest extends TestCase
{
    public function testGetExpiredData(): void
    {
        $service = new MessageService();

        $expiredData = $service->getExpiredDate();

        self::assertTrue($expiredData instanceof Carbon);
    }
}
