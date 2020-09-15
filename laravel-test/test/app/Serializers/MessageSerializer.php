<?php

declare(strict_types=1);

namespace App\Serializers;

use App\Entity\Message;

class MessageSerializer
{
    public function jsonMessage(Message $message, $messageDbId): array
    {
        return [
            'id' => $messageDbId,
            'message' => $message->getAttribute('message'),
            'error' => false,
        ];
    }
}
