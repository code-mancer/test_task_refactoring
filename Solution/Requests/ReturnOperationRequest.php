<?php

namespace Requests;
class ReturnOperationRequest
{
    private array $data;

    public const DATA = 'data';
    public const RESELLER_ID = 'resellerId';
    public const NOTIFICATION_TYPE = 'notificationType';
    public const CLIENT_ID = 'clientId';
    public const CREATOR_ID = 'creatorId';
    public const EXPERT_ID = 'expertId';
    public const DIFFERENCES = 'differences';
    public const FROM = 'from';
    public const TO = 'to';
    public const COMPLAINT_ID = 'complaintId';
    public const COMPLAINT_NUMBER = 'complaintNumber';
    public const CONSUMPTION_ID = 'consumptionId';
    public const CONSUMPTION_NUMBER = 'consumptionNumber';
    public const AGREEMENT_NUMBER = 'agreementNumber';
    public const DATE = 'date';

    private const REQUIRED_KEYS = [
        self::DATA,
        self::RESELLER_ID,
        self::NOTIFICATION_TYPE,
        self::CLIENT_ID,
        self::CREATOR_ID,
        self::EXPERT_ID,
        self::DIFFERENCES,
        self::COMPLAINT_ID,
        self::COMPLAINT_NUMBER,
        self::CONSUMPTION_ID,
        self::CONSUMPTION_NUMBER,
        self::AGREEMENT_NUMBER,
        self::DATE,
    ];

    private const REQUIRED_DIFFERENCE_KEYS = [
        self::FROM,
        self::TO
    ];

    private string $validationErrorMessage = 'is required and cannot be empty';
    private int $validationErrorCode = 422;

    public function __construct()
    {
        $this->data = $_REQUEST[self::DATA];
        $this->validate();
    }

    private function validate(): void
    {
        foreach (self::REQUIRED_KEYS as $key) {
            if (!array_key_exists($key, $this->data)) {
                throw new \InvalidArgumentException("{$key}{$this->validationErrorMessage}", $this->validationErrorCode);
            }

            if ($key === self::DIFFERENCES) {
                foreach (self::REQUIRED_DIFFERENCE_KEYS as $difKey) {
                    if (!array_key_exists($difKey, $this->data)) {
                        throw new \InvalidArgumentException("{$key}{$this->validationErrorMessage}", $this->validationErrorCode);
                    }
                }
            }
        }
    }

    public function getResellerId(): ?int
    {
        return (int)$this->data[self::RESELLER_ID];
    }

    public function getNotificationType(): ?int
    {
        return (int)$this->data[self::NOTIFICATION_TYPE];
    }

    public function getComplaintId(): int
    {
        return (int)$this->data[self::COMPLAINT_ID];
    }

    public function getClientId(): int
    {
        return (int)$this->data[self::CLIENT_ID];
    }

    public function getCreatorId(): int
    {
        return (int)$this->data[self::CREATOR_ID];
    }

    public function getExpertId(): int
    {
        return (int)$this->data[self::EXPERT_ID];
    }

    public function getDifferences(): array
    {
        return $this->data[self::DIFFERENCES];
    }

    public function getDifferencesFrom(): int
    {
        return (int)$this->data[self::DIFFERENCES][self::FROM];
    }

    public function getDifferencesTo(): int
    {
        return (int)$this->data[self::DIFFERENCES][self::TO];
    }

    public function getComplaintNumber(): string
    {
        return $this->data[self::COMPLAINT_NUMBER];
    }

    public function getConsumptionId(): int
    {
        return (int)$this->data[self::CONSUMPTION_ID];
    }

    public function getConsumptionNumber(): string
    {
        return $this->data[self::CONSUMPTION_NUMBER];
    }

    public function getAgreementNumber(): string
    {
        return $this->data[self::AGREEMENT_NUMBER];
    }

    public function getDate(): string
    {
        return $this->data[self::DATE];
    }
}
