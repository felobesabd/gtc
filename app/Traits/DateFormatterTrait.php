<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateFormatterTrait
{
    public function formatDate($dateString, $inputFormat = 'd-m-Y', $outputFormat = 'Y-m-d')
    {
        return Carbon::createFromFormat($inputFormat, $dateString)->format($outputFormat);
    }
}
