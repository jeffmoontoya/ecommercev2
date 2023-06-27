<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Jeff',
                'lastname' => 'Montoya',
                'username' => 'jeffmontoya',
                'email' => 'jeffmoontoya@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ]);
    }
}
