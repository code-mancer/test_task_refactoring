<?php

namespace Entities;

use Exception;

/**
 * @property int $id
 * @property string $name
 */
class Status
{
    /**
     * @throws \Exception
     */
    public static function getById(int $id): Status
    {
        $status = new self($id);

        if (is_null($status)) {
            throw new Exception('Status not found!', 400);
        }

        return $status;
    }

    /**
     * @throws Exception
     */
    public static function getName(int $id): string
    {
        $a = [
            0 => 'Completed',
            1 => 'Pending',
            2 => 'Rejected',
        ];

        if (!array_key_exists($id, $a)) {
            throw new Exception('Incorrect notification differences');
        }

        return $a[$id];
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}