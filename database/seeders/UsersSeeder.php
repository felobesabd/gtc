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

        // customer
        $customerRole = Role::updateOrCreate(
            [
                'name' => 'customer'
            ],
            []
        );
        $customer = User::updateOrCreate(
            [
                'email' => 'customer@customer.com'
            ],
            [
                'full_name' => 'customer',
                'phone_number' => '01555',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('customer'),
            ]
        );
        $customer->assignRole($customerRole);

        // notary
        $notaryRole = Role::updateOrCreate(
            [
                'name' => 'notary'
            ],
            []
        );
        $notary = User::updateOrCreate(
            [
                'email' => 'notary@notary.com'
            ],
            [
                'full_name' => 'notary',
                'phone_number' => '01522114555',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('notary'),
            ]
        );
        $notary->assignRole($notaryRole);

        // chartered_accountant
        $chartered_accountantRole = Role::updateOrCreate(
            [
                'name' => 'chartered_accountant'
            ],
            []
        );
        $chartered_accountant = User::updateOrCreate(
            [
                'email' => 'chartered_accountant@chartered_accountant.com'
            ],
            [
                'full_name' => 'Ahmed Eid',
                'phone_number' => '0122555',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('chartered_accountant'),
            ]
        );
        $chartered_accountant->assignRole($chartered_accountantRole);

        // lawyer
        $lawyerRole = Role::updateOrCreate(
            [
                'name' => 'lawyer'
            ],
            []
        );
        $lawyer = User::updateOrCreate(
            [
                'email' => 'lawyer@lawyer.com'
            ],
            [
                'full_name' => 'ahmed hafez',
                'phone_number' => '012345',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('notary'),
            ]
        );
        $lawyer->assignRole($lawyerRole);
        $lawyer = User::updateOrCreate(
            [
                'email' => 'lawyer2@law.com'
            ],
            [
                'full_name' => 'Mahmoud Salama',
                'phone_number' => '01202345',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('notary'),
            ]
        );
        $lawyer->assignRole($lawyerRole);
        $lawyer = User::updateOrCreate(
            [
                'email' => 'ahmed@law.com'
            ],
            [
                'full_name' => 'Hazem Amer',
                'phone_number' => '015345',
                'city_id' => 1,
                'license_type' => '0',
                'license_attachment_id' => '0',
                'have_legal_establishment' => '0',
                'cv' => '',
                'password' => Hash::make('notary'),
            ]
        );
        $lawyer->status = Status::Active->value;
        $lawyer->save();
        $lawyer->assignRole($lawyerRole);

    }
}
