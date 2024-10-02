<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Privilege extends Model
{
    use HasFactory;
    protected $table = 'privileges';

    protected $fillable = [
        'user_id', 'page_name', 'show_action', 'add_action', 'edit_action', 'delete_action', 'additional_permissions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roles()
    {
        return DB::table('roles')->get();
    }

    public function getPermissionByUser($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    }
}
