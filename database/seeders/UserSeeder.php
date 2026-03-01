<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hasan Sarıköse',
            'email' => 'hasan@example.com',
            'password' => bcrypt('password'),
            'team_id' => 1,  // Örnek olarak Cyberova Team
        ]);
    }
}
