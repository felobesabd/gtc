<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'category_id',
        'group_id',
        'part_no',
        'unit_id',
        'quantity',
        'rate',
        'rate_per',
        'min_allowed_value',
    ];

//    public function getCategoryName($category_id)
//    {
//        $category = self::query()
//            ->join('categories', 'categories.id', '=', 'item_categories.category_id')
//            ->where('categories.id', $category_id)
//            ->value('categories.category_name');
//
//        return $category ?: '---';
//    }
//
//    public function getGroupName($group_id)
//    {
//        $group = self::query()
//            ->join('groups', 'groups.id', '=', 'item_categories.group_id')
//            ->where('groups.id', $group_id)
//            ->value('groups.group_name');
//
//        return $group ?: '---';
//    }
//
//    public function getUnitName($unit_id)
//    {
//        $unit = self::query()
//            ->join('units', 'units.id', '=', 'item_categories.unit_id')
//            ->where('units.id', $unit_id)
//            ->value('units.name');
//
//        return $unit ?: '---';
//    }

    public function getNameById($table, $id, $idColumn, $selfId, $nameColumn)
    {
        $name = self::query()
            ->join($table, "$table.$idColumn", '=', "item_categories.$selfId")
            ->where("$table.$idColumn", $id)
            ->value("$table.$nameColumn");

        return $name ?: '---';
    }
}
