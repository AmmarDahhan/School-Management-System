<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Ammar Dahhan',
            'email' => 'ammarmemo096@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
