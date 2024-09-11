<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'age',
        'images',
        'passport_no',
        'country',
        'date_of_birth',
        'bus_no',
        'license_no',
        'license_expired',
    ];

    protected function attachmentsIds(): Attribute
    {
        return Attribute::make(
            get: function (?string $value, array $attributes) {
                if (json_decode($attributes['images'] ?? null)) {
                    return json_decode($attributes['images'], true);
                } else {
                    return [];
                }
            },
            set: fn(array $value) => json_encode($value),
        );
    }

    public function attachments(): Collection
    {
        $attach_ids = json_decode($this->images);
        $attachments = Attachment::whereIn('id', $attach_ids)->get();
        return $attachments;
    }
}
