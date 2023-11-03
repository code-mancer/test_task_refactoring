<?php

namespace Services;

use DTO\SendNotificationDTO;
use Resources\OperationResultResource;

class NotificationService
{
    public function __construct(
        protected EmailService $emailService
    ) {}

    public function sendNotifications(SendNotificationDTO $DTO): array
    {
        $notificationEmployeeByEmail = $this->emailService->sendToEmployeeByEmail($DTO->template, $DTO->resellerId);
        list($notificationClientByEmail, $isSent, $message) = $this->emailService->sendToEmployeeClientByEmail(
            $DTO->template,
            $DTO->resellerId,
            $DTO->notificationType,
            $DTO->client,
            $DTO->diffTO
        );

        return OperationResultResource::toArray(
            $notificationEmployeeByEmail,
            $notificationClientByEmail,
            $isSent,
            $message
        );
    }
}

