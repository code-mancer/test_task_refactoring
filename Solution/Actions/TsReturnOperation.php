<?php

namespace Actions;

use Abstracts\ReferencesOperation;
use DTO\SendNotificationDTO;
use Entities\Status;
use Exception;
use Requests\ReturnOperationRequest;
use Resources\OperationResultResource;
use Services\CheckDataEntityAndGet;
use Services\NotificationService;

class TsReturnOperation extends ReferencesOperation
{
    public function __construct(
        protected ReturnOperationRequest $request,
        protected NotificationService $notificationService,
        protected CheckDataEntityAndGet $checkDataEntityAndGet,
    ) {}

    /**
     * @throws Exception
     */
    public function doOperation(): array
    {
        if (empty($this->request->getResellerId())) {
            return OperationResultResource::toArray(message: 'Empty resellerId');
        }

        $this->checkParams();

        list($reseller, $client, $clientFullName, $creator, $expert) = $this->checkDataEntityAndGet->run(
            $this->request->getResellerId(),
            $this->request->getClientId(),
            $this->request->getCreatorId(),
            $this->request->getExpertId(),
        );

        $differences = $this->getDifferences();


        $template = SendNotificationDTO::fromRequestData(
            $this->request,
            $clientFullName,
            $creator,
            $expert,
            $differences
        );

        $DTO = SendNotificationDTO::fromParams(
            template: $template,
            resellerId: $this->request->getResellerId(),
            notificationType: $this->request->getNotificationType(),
            client: $client,
            diffTO: $this->request->getDifferencesTo(),
        );

        return $this->notificationService->sendNotifications($DTO);
    }

    /**
     * @throws \Exception
     */
    private function checkParams(): void
    {
        if (empty($this->request->getNotificationType())) {
            throw new Exception('Empty notificationType', 400);
        }

    }

    /**
     * @throws Exception
     */
    private function getDifferences(): string
    {
        switch ($this->request->getNotificationType()) {
            case self::TYPE_NEW:
                $differences = 'New position added';
                break;
            case self::TYPE_CHANGE:
                $fromStatus = Status::getName($this->request->getDifferencesFrom());
                $toStatus = Status::getName($this->request->getDifferencesTo());
                $differences = "Position status has changed from $fromStatus to $toStatus";
                break;
            default:
                $differences = '';
                break;
        }

        return $differences;
    }
}
