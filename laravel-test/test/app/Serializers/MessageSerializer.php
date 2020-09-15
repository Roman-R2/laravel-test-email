<?php

declare(strict_types=1);

namespace App\Serializers;

use App\Entity\Message;

class MessageSerializer
{
    public function jsonMessage(Message $message, $messageDbId): array
    {
        return $this->createResponseArray(
            $messageDbId,
            $message->getAttribute('message')
        );
    }

    public function jsonErrorMessage($errorMessage): array
    {
        return $this->createResponseArray(
            null,
            null,
            [
                $errorMessage
            ]
        );
    }

    public function createResponseArray($id, $message, $error = [])
    {
        return [
            'id' => $id,
            'message' => $message,
            'error' => $error,
        ];
    }
}
