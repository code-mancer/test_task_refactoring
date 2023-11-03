<?php

namespace Entities;

use Exception;

/**
 * @property int $id
 * @property string $name
 */
class Seller
{
    /**
     * @throws Exception
     */
    public static function getById(int $id): Seller
    {
        $reseller = new self($id);

        if (is_null($reseller)) {
            throw new \Exception('Seller not found!', 400);
        }

        return $reseller;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}