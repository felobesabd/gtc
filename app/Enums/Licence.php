<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum Status: int
{
    use BaseEnumTrait;

    case Lawyer = 1;
    case Accountant = 2;
    case Notary = 3;

}
