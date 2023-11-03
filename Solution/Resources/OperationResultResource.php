<?php

namespace Resources;
class OperationResultResource
{
    public static function toArray(
        bool   $notificationEmployeeByEmail = false,
        bool   $notificationClientByEmail = false,
        bool   $isSent = false,
        string $message = ''
    ): array
    {
        return [
            'notificationEmployeeByEmail' => $notificationEmployeeByEmail,
            'notificationClientByEmail' => $notificationClientByEmail,
            'notificationClientBySms' => [
                'isSent' => $isSent,
                'message' => $message,
            ],
        ];
    }
}