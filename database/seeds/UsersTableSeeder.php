<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => '$2y$10$j1gM9CdfEBdOsxSW2Tje0eDoIbJsB7rFatHF/i1NZLYN5iCUBhkRO',
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2020-07-01 17:51:21',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}