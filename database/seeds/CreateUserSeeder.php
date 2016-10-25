<?php

use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            
            ['email' => 'admin@frankapp.com', 'password' => bcrypt('admin'),'name'=>'Admin'],
            ['email' => 'joeydngcng1231@gmail.com', 'password' => bcrypt('admin'),'name'=>'Joey Dingcong'],

        ]);
    }
}
