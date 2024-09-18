<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'amount',
        'attachment_id',
    ];

    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id')->withDefault();
    }
}
