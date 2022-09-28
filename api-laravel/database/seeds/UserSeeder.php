<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //seed users table
        DB::table('users')->insert([
            'username' => 'Kamzen',
            'email' => 'kamzen1994@gmail.com',
            'firstname' => 'Tiyisela',
            'lastname' => 'Makamu',
            'password' => Hash::make('@Kamzen'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

    }
}
