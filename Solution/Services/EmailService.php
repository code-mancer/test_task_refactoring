<?php

namespace Services;

use Abstracts\ReferencesOperation;
use Entities\Contractor;
use Enums\NotificationEvents;
use Fakers\EmailsFaker;

class EmailService
{
    public function sendToEmployeeByEmail(array $templateData, int $resellerId): bool
    {
        $emailFrom = EmailsFaker::getResellerEmailFrom();
        $emails = EmailsFaker::getEmailsByPermit();

        if (!empty($emailFrom) && count($emails) > 0) {
            foreach ($emails as $email) {
                MessagesClient::sendMessage([
                    0 => [
                        'emailFrom' => $emailFrom,
                        'emailTo'   => $email,
                        'subject'   => __('complaintEmployeeEmailSubject', $templateData, $resellerId),
                        'message'   => __('complaintEmployeeEmailBody', $templateData, $resellerId),
                    ],
                ], $resellerId, NotificationEvents::CHANGE_RETURN_STATUS);

                return true;
            }
        }

        return false;
    }

    public function sendToEmployeeClientByEmail(
        array $templateData,
        int $resellerId,
        int $notType,
        Contractor $client,
        int $diffTo
    ): array
    {
        $emailFrom = EmailsFaker::getResellerEmailFrom();

        if ($notType === ReferencesOperation::TYPE_CHANGE) {
            if (!empty($emailFrom) && !empty($client->email)) {
                MessagesClient::sendMessage([
                    0 => [
                        'emailFrom' => $emailFrom,
                        'emailTo'   => $client->email,
                        'subject'   => __('complaintClientEmailSubject', $templateData, $resellerId),
                        'message'   => __('complaintClientEmailBody', $templateData, $resellerId),
                    ],
                ], $resellerId, $client->id, NotificationEvents::CHANGE_RETURN_STATUS, $diffTo);
                $notificationClientByEmail = true;
            }

            if (!empty($client->mobile)) {
                $res = NotificationManager::send($resellerId, $client->id, NotificationEvents::CHANGE_RETURN_STATUS, $diffTo, $templateData, &$error);
                if ($res) {
                    $isSent = true;
                }
                if (!empty($error)) {
                    $message = $error;
                }
            }
        }

        return [$notificationClientByEmail, $isSent, $message];
    }
}
