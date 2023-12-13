<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'role_id'=>'1',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123456')
        ]);

        User::create([
            'name'=>'Author',
            'role_id'=>'2',
            'email'=>'author@gmail.com',
            'password'=>Hash::make('123456')
        ]);
    }
}
