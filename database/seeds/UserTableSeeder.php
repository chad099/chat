<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'type'=>'admin',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'type'=>'user',
            'password' => bcrypt('123456'),
        ]);
    }
}
