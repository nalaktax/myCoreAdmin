<?php

use Illuminate\Database\Seeder;
class AdminDefaultUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	 DB::table('roles')->insert([
        		'name' 	=> 'Super Admin',
        		'status' 	=> 'y'
        	]);

        	$firstRole =  DB::table('roles')->select('id')->where('name', 'Super Admin')->first();
        	DB::table('users')->insert([
        		'role_id' 	=> $firstRole->id,
        		'name'		=> 'Super Administrator',
        		'username' 	=> 'superadmin',
        		'email' 	=> 'SuperAdmin@mail.com',
        		'password' 	=> bcrypt('superadmin')
        	]);
    }
}
