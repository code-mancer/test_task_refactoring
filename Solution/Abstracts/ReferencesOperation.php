<?php

namespace Abstracts;

abstract class ReferencesOperation
{
    public const TYPE_NEW    = 1;
    public const TYPE_CHANGE = 2;

    abstract public function doOperation();
}
