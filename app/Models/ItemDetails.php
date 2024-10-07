<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_card_id', 'quantity', 'description', 'cost', 'part_number'
    ];
}
