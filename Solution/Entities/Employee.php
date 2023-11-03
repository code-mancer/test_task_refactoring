<?php

namespace Entities;

/**
 * @property int $id
 * @property string $name
 */
class Employee
{
    public static function getById(int $id, string $key): Employee
    {
        $employee = new self($id);

        if (is_null($employee)) {
            throw new \Exception('$key not found!', 400);
        }

        return $employee;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}