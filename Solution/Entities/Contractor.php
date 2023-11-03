<?php

namespace Entities;

use Exception;

/**
 * @property Seller $seller
 * @property int $id
 * @property string $name
 */
class Contractor
{
    const TYPE_CUSTOMER = 0;
    public int $id;
    public string $type;
    public string $name;

    /**
     * @throws Exception
     */
    public static function getById(int $resellerId): self
    {
        $reseller = new self($resellerId);

        if (is_null($reseller)) {
            throw new \Exception('Status not found!', 400);
        }

        return $reseller;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}