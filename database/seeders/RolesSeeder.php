<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run() {
        $default = Role::updateOrCreate(['name' => 'default']);
        $admin = Role::updateOrCreate(['name' => 'admin']);


        $admin_permissions = [
            Permission::updateOrCreate(['name' => 'admin.edit']),
            // category
            Permission::updateOrCreate(['name' => 'category.list']),
            Permission::updateOrCreate(['name' => 'category.add']),
            Permission::updateOrCreate(['name' => 'category.edit']),
            Permission::updateOrCreate(['name' => 'category.delete']),
            // department
            Permission::updateOrCreate(['name' => 'department.list']),
            Permission::updateOrCreate(['name' => 'department.add']),
            Permission::updateOrCreate(['name' => 'department.edit']),
            Permission::updateOrCreate(['name' => 'department.delete']),
            // driver
            Permission::updateOrCreate(['name' => 'driver.list']),
            Permission::updateOrCreate(['name' => 'driver.show']),
            Permission::updateOrCreate(['name' => 'driver.add']),
            Permission::updateOrCreate(['name' => 'driver.edit']),
            Permission::updateOrCreate(['name' => 'driver.delete']),
            // employee
            Permission::updateOrCreate(['name' => 'employee.list']),
            Permission::updateOrCreate(['name' => 'employee.show']),
            Permission::updateOrCreate(['name' => 'employee.add']),
            Permission::updateOrCreate(['name' => 'employee.edit']),
            Permission::updateOrCreate(['name' => 'employee.delete']),
            // group
            Permission::updateOrCreate(['name' => 'group.list']),
            Permission::updateOrCreate(['name' => 'group.add']),
            Permission::updateOrCreate(['name' => 'group.edit']),
            Permission::updateOrCreate(['name' => 'group.delete']),
            // expenses
            Permission::updateOrCreate(['name' => 'expenses.list']),
            Permission::updateOrCreate(['name' => 'expenses.add']),
            Permission::updateOrCreate(['name' => 'expenses.edit']),
            Permission::updateOrCreate(['name' => 'expenses.delete']),
            // items
            Permission::updateOrCreate(['name' => 'items.list']),
            Permission::updateOrCreate(['name' => 'items.add']),
            Permission::updateOrCreate(['name' => 'items.edit']),
            Permission::updateOrCreate(['name' => 'items.delete']),
            Permission::updateOrCreate(['name' => 'items.import']),
            // job_card
            Permission::updateOrCreate(['name' => 'job_card.list']),
            Permission::updateOrCreate(['name' => 'job_card.add']),
            Permission::updateOrCreate(['name' => 'job_card.edit']),
            Permission::updateOrCreate(['name' => 'job_card.delete']),
            // roles
            Permission::updateOrCreate(['name' => 'roles.list']),
            Permission::updateOrCreate(['name' => 'roles.add']),
            Permission::updateOrCreate(['name' => 'roles.edit']),
            Permission::updateOrCreate(['name' => 'roles.delete']),
            // sales
            Permission::updateOrCreate(['name' => 'sales.list']),
            Permission::updateOrCreate(['name' => 'sales.add']),
            Permission::updateOrCreate(['name' => 'sales.edit']),
            Permission::updateOrCreate(['name' => 'sales.delete']),
            // store_location
            Permission::updateOrCreate(['name' => 'store_location.list']),
            Permission::updateOrCreate(['name' => 'store_location.add']),
            Permission::updateOrCreate(['name' => 'store_location.edit']),
            Permission::updateOrCreate(['name' => 'store_location.delete']),
            // supplier
            Permission::updateOrCreate(['name' => 'supplier.list']),
            Permission::updateOrCreate(['name' => 'supplier.add']),
            Permission::updateOrCreate(['name' => 'supplier.edit']),
            Permission::updateOrCreate(['name' => 'supplier.delete']),
            // unit
            Permission::updateOrCreate(['name' => 'unit.list']),
            Permission::updateOrCreate(['name' => 'unit.add']),
            Permission::updateOrCreate(['name' => 'unit.edit']),
            Permission::updateOrCreate(['name' => 'unit.delete']),
            // user
            Permission::updateOrCreate(['name' => 'user.list']),
            Permission::updateOrCreate(['name' => 'user.add']),
            Permission::updateOrCreate(['name' => 'user.edit']),
            Permission::updateOrCreate(['name' => 'user.delete']),
            // vehicle
            Permission::updateOrCreate(['name' => 'vehicle.list']),
            Permission::updateOrCreate(['name' => 'vehicle.add']),
            Permission::updateOrCreate(['name' => 'vehicle.edit']),
            Permission::updateOrCreate(['name' => 'vehicle.delete']),
        ];

        $admin->syncPermissions($admin_permissions);
    }
}
