<?php

namespace App\Constant;

use App\Traits\EnumToArray;

enum TaskStatus: string
{
    use EnumToArray;
    case BackLog = 'BackLog';
    case IN_PROGRESS = 'In Process';
    case Done = 'Done';

    public static function getOptions(): array
    {
        // not really like to save status with string which include space to database
        return array_combine(self::values(), self::values());
    }
}
