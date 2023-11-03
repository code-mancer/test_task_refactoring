<?php

namespace Enums;

enum OperationEnum
{
    public const TYPE_NEW = 1;
    public const TYPE_CHANGE = 2;

    public const OPERATION_TYPES = [
        self::TYPE_NEW,
        self::TYPE_CHANGE
    ];
}
