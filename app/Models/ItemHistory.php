<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'reason_out', 'price', 'cost', 'supply_order_no', 'quantity_out', 'job_card',
    ];
}
