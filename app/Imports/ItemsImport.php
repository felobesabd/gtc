<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\ItemCategory;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToModel, WithHeadingRow
{
    protected $categories;
    protected $groups;
    protected $units;

    public function __construct($categories, $groups, $units)
    {
        $this->categories = $categories;
        $this->groups = $groups;
        $this->units = $units;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ItemCategory([
            'item_name'             => $row['name'],
            'category_id'           => $this->getCategoryId($row['category']),
            'group_id'              => $this->getGroupId($row['group_name']),
            'part_no'               => $row['part_no'],
            'unit_id'               => $this->getUnitId($row['units']),
            'quantity'              => $row['opening_balance_quantity'],
            'rate'                  => $this->getValidDecimalValue($row['opening_balance_rate']),
            'rate_per'              => $this->getValidDecimalValue($row['opening_balance_rate_per']),
            'opening_balance_value' => $this->getValidDecimalValue($row['opening_balance_value']),
        ]);
    }

    private function getCategoryId($categoryName)
    {
        // for each if $categoryName == group->$category->name return $category->id else return error
        foreach ($this->categories as $category) {
            if ($category->category_name === $categoryName) {
                return $category->id;
            }
        }

        throw ValidationException::withMessages([
            'file' => "Category not found for: " . $categoryName,
        ]);
    }

    private function getGroupId($groupName)
    {
        foreach ($this->groups as $group) {
            if ($group->group_name === $groupName) {
                return $group->id;
            }
        }

        throw ValidationException::withMessages([
            'file' => "Groups not found for: " . $groupName,
        ]);
    }

    private function getUnitId($unitName)
    {
        foreach ($this->units as $unit) {
            if ($unit->unit_type === $unitName) {
                return $unit->id;
            }
        }

        throw ValidationException::withMessages([
            'file' => "Units not found for: " . $unitName,
        ]);
    }

    private function getValidDecimalValue($value)
    {
        return is_numeric($value) ? $value : null;
    }

    /*$category = $this->categories->firstWhere('name', $categoryName);
            return $category ? $category->id : null;*/
}

