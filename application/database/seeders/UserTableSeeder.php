<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin data
            [
                'name'      => 'Admin',
                'username'  => 'admin',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('admin'),
                'role'      => 'admin',
                'status'    => '1',
            ],

            //instructor data
            [
                'name'      => 'Instructor',
                'username'  => 'instructor',
                'email'     => 'instructor@gmail.com',
                'password'  => Hash::make('instructor'),
                'role'      => 'instructor',
                'status'    => '1',
            ],

            //user data
            [
                'name'      => 'Robert Fred',
                'username'  => 'user',
                'email'     => 'user@gmail.com',
                'password'  => Hash::make('user'),
                'role'      => 'user',
                'status'    => '1',
            ],

        ]);
    }
}
