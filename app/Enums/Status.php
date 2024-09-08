<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum Status: int
{
    use BaseEnumTrait;

    case Active = 1;
    case Pending = 2;
    case Inactive = 3;

}
