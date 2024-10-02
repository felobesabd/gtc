<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        $adminRole = Role::updateOrCreate(
            [
                'name' => 'admin'
            ],
            []
        );
        $admin = User::updateOrCreate(
            [
                'email' => 'admin@admin.com'
            ],
            [
                'full_name' => 'admin',
                'phone_number' => '01025255',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('123@E014Gh4'),
            ]
        );
        $admin->assignRole($adminRole);

        // admin
        $warehouseManagerRole = Role::updateOrCreate(
            [
                'name' => 'warehouse manager'
            ],
            []
        );
        $admin = User::updateOrCreate(
            [
                'email' => 'mohmd@mohmd.com'
            ],
            [
                'full_name' => 'Mohammed',
                'phone_number' => '01025251241',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('123'),
            ]
        );
        $admin->assignRole($warehouseManagerRole);

        // customer
        $customerRole = Role::updateOrCreate(
            [
                'name' => 'default'
            ],
            []
        );
        $customer = User::updateOrCreate(
            [
                'email' => 'phelo@gmail.com'
            ],
            [
                'full_name' => 'customer',
                'phone_number' => '01501254785',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('phelo'),
            ]
        );
        $customer->assignRole($customerRole);
    }
}
