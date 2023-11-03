<?php

namespace Services;

use Entities\Contractor;
use Entities\Employee;
use Entities\Seller;
use Exception;

class CheckDataEntityAndGet
{
    /**
     * @throws Exception
     */
    public function run(int $resellerId, int $clientId, int $creatorId, int $expertId): array
    {
        $reseller = Seller::getById($resellerId);
        $client = Contractor::getById($clientId);
        $clientFullName = $this->genClientFullName($client);
        $creator = Employee::getById($creatorId, 'Creator');
        $expert = Employee::getById($expertId, 'Expert');

        return [$reseller, $client, $clientFullName, $creator, $expert];
    }

    private function genClientFullName($client)
    {
        $clientFullName = $client->getFullName();

        if (empty($client->getFullName())) {
            $clientFullName = $client->name;
        }

        return $clientFullName;
    }
}