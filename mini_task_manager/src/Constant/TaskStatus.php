<?php

namespace App\Constant;

use App\Traits\EnumToArray;

enum TaskStatus: string
{
    use EnumToArray;
    case BackLog = 'BackLog';
    case IN_PROGRESS = 'In Process';
    case Done = 'Done';
}
