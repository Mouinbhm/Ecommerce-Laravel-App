<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' =>'admin@admin.com',
                'role' => 'admin',
                'password'=> bcrypt('123456'),
            ]
            );
    }
}
