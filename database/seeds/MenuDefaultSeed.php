<?php

use Illuminate\Database\Seeder;

class MenuDefaultSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //create parent menu admin
        $view[] = DB::table('actions')->select('name')->where('name','view')->first()->name; 
        DB::table('menus')->insert([
        		'name' => 'Admin Management',
        		'slug' => 'admin',
        		'description' => 'Parent Menu Admin',
        		'action' => json_encode($view),
        		'order' => 1,
        	]);

         $datas = DB::table('actions')->select('name')->get();
        
        //getting parent 
        $parent = DB::table('menus')->whereSlug('admin')->first();
        foreach ($datas as $data)
        {
        		$actions[] = $data->name;
        }	
        
        $data = [
        			0 => [
        				'name' => 'Roles Management',
        				'controller' => 'RolesController',
        				'parent_id' => $parent->id,
        				'slug' => 'roles',
        				'action'=>  json_encode($actions),
        				'description' => 'Menu For Managing Roles Users',
        				'order' => 2
        			],
        			1 => [
        				'name' => 'Users Management',
        				'controller' => 'UsersController',
        				'parent_id' => $parent->id,
        				'slug' => 'users',
        				'action'=>  json_encode($actions),
        				'description' => 'Menu For Managing Users Application',
        				'order' => 3
        			],
        			2 => [
        				'name' => 'Actions Management',
        				'controller' => 'ActionsController',
        				'parent_id' => $parent->id,
        				'slug' => 'actions',
        				'action'=>  json_encode($actions),
        				'description' => 'Menu For Managing Roles Acctions',
        				'order' => 1
        			],
        			
        		];
        DB::table('menus')->insert($data);
    }
}
