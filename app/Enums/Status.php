<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum Status: int
{
    use BaseEnumTrait;

    case Pending = 0;
    case Completed = 1;
    case Canceled = 2;
    case Active = 5;
    case Inactive = 6;

    public static function jobCardCases() {
        $arr = [];
        $arr[] = Self::Pending;
        $arr[] = Self::Completed;
        $arr[] = Self::Canceled;
        return $arr;
    }
}
