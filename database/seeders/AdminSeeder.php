<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'Admin',
                'password' => bcrypt('Admin123'),
                'role_as' => 1,

            ]
        );
    }
}
