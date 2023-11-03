<?php

namespace Fakers;

class EmailsFaker
{
    public static function getResellerEmailFrom(): string
    {
        return 'contractor@example.com';
    }

    public static function getEmailsByPermit(): array
    {
        return ['someemeil@example.com', 'someemeil2@example.com'];
    }

}