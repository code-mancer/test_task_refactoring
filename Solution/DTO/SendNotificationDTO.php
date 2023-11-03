<?php

namespace DTO;

use Entities\Contractor;
use Entities\Employee;
use Requests\ReturnOperationRequest;

/**
 * @method fromRequestData()
 */
class SendNotificationDTO
{
    public array $template;
    public int $resellerId;
    public int $notificationType;
    public Contractor $client;
    public string $diffTO;

    public function __construct(
        array $template,
        int $resellerId,
        int $notificationType,
        Contractor $client,
        string $diffTO
    ) {
    }

    public static function fromRequestData(
        ReturnOperationRequest $request,
        string $clientFullName,
        Employee $creator,
        Employee $expert,
        string $differences
    ): array {
        return [
            'COMPLAINT_ID' => $request->getComplaintId(),
            'COMPLAINT_NUMBER' => $request->getComplaintNumber(),
            'CREATOR_ID' => $request->getCreatorId(),
            'CREATOR_NAME' => $creator->getFullName(),
            'EXPERT_ID' => $request->getExpertId(),
            'EXPERT_NAME' => $expert->getFullName(),
            'CLIENT_ID' => $request->getClientId(),
            'CLIENT_NAME' => $clientFullName,
            'CONSUMPTION_ID' => $request->getConsumptionId(),
            'CONSUMPTION_NUMBER' => $request->getConsumptionNumber(),
            'AGREEMENT_NUMBER' => $request->getAgreementNumber(),
            'DATE' => $request->getDate(),
            'DIFFERENCES' => $differences,
        ];
    }

    public static function fromParams(
        array $template,
        int $resellerId,
        int $notificationType,
        Contractor $client,
        string $diffTO
    ): self {
        return new self(
            template: $template,
            resellerId: $resellerId,
            notificationType: $notificationType,
            client: $client,
            diffTO: $diffTO,
        );
    }
}