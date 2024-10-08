<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class IncidentalExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation_type',
        'comments',
        'amount',
        'attachment_id',
    ];

    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id')->withDefault();
    }
}
