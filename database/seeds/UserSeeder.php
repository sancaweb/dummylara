<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'sanca',
            'email' => "sanca.snake@gmail.com",
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => "user@gmail.com",
            'password' => bcrypt('password')
        ]);

        $user->assignRole('user');
    }
}
