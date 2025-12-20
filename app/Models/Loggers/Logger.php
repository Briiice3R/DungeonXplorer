<?php

namespace App\Models\Loggers;

abstract class Logger
{
    public abstract static function log($entity);
}