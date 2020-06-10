<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        	 'name' => 'Administrator', 
             'email' => 'admin@mail.com', 
             'password' => bcrypt('admin'),
             'nik' => '773764374',
             'alamat' => 'Bitung',
             'role' => '0',
            ]
        ];

        DB::table('users')->insert($users);
    }
}
