<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name', 'email', 'phone_number', 'password', 'employee_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function licenseAttachment()
    {
        return $this->belongsTo(Attachment::class, 'license_attachment_id')->withDefault();
    }

    public function legalEstablishmentAttachment()
    {
        return $this->belongsTo(Attachment::class, 'legal_establishment_attachment_id')->withDefault();
    }

    public function privileges()
    {
        return $this->belongsToMany(Role::class, 'privileges', 'user_id', 'id');
    }

}
