<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum Status: int
{
    use BaseEnumTrait;

    case Pending = 0;
    case InProgress = 1;
    case Completed = 2;
    case Canceled = 3;
    case Confirmed = 4;
    case Active = 5;
    case Inactive = 6;

    public static function jobCardCases() {
        $arr = [];
        $arr[] = Self::Pending;
        $arr[] = Self::InProgress;
        $arr[] = Self::Completed;
        $arr[] = Self::Canceled;
        $arr[] = Self::Confirmed;
        return $arr;
    }
}
