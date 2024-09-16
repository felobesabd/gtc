<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'chassis_no',
        'category_id',
        'group_id',
        'capacity',
        'color',
        'vehicle_type',
        'gearbox_no',
        'machine_no',
        'plate_no',
        'license_no',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function getCategoryName($category_id)
    {
        $category = self::query()
            ->join('categories', 'categories.id', '=', 'vehicles.category_id')
            ->where('categories.id', $category_id)
            ->value('categories.category_name');

        return $category ?: '---';
    }

    public function getGroupName($group_id)
    {
        $group = self::query()
            ->join('groups', 'groups.id', '=', 'vehicles.group_id')
            ->where('groups.id', $group_id)
            ->value('groups.group_name');

        return $group ?: '---';
    }
}
