<?php

use Illuminate\Database\Seeder;

class AdminDefaultSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
        		/* Insert Action */
        		$data = [
        			0 => [
        				'name' => 'view',
        				'status' => 'y',
        				'description' => 'Action For View Data'
        			],
        			
        			1 => [
        				'name' => 'create',
        				'status' => 'y',
        				'description' => 'Action For Create Data'
        			],
        			
        			2 => [
        				'name' => 'update',
        				'status' => 'y',
        				'description' => 'Action For Upadate Data'
        			],
        			
        			3 => [
        				'name' => 'delete',
        				'status' => 'y',
        				'description' => 'Action For Delete Data'
        			]
        		];
        		DB::table('actions')->insert($data);
        		/* *********** */	

        		/* Insert User And Role */
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
        		/* ********** */

        		/* Insert Menu */
        			$view[] = DB::table('actions')->select('name')->where('name','view')->first()->name; 
        			/* Parent Menu */
	        			DB::table('menus')->insert([
			        		'name' => 'Admin Management',
			        		'slug' => 'admin',
			        		'description' => 'Parent Menu Admin',
			        		'action' => json_encode($view),
			        		'order' => 1,
	        			]);
        			/* *********** */
        			$dataActions = DB::table('actions')->select('name')->get();
        
		        	//getting parent 
		        	$parent = DB::table('menus')->whereSlug('admin')->first();
		        	foreach ($dataActions as $dataAction)
		        	{
		        		$actions[] = $dataAction->name;
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
        		/* *********** */
        		
        		/* Default Assigment */
        			$menus = DB::table('menus')->select('id','action')->get();
        		        	foreach ($menus as $menu)
		        	{
		        		$listActions = json_decode($menu->action);
		        		foreach ($listActions as $actionName) {
			        		$action = DB::table('actions')->select('id')->whereName($actionName);

			        		if ($action->count() > 0) 
			        		{
			        			DB::table('assigments')->insert([
					        		'menu_id' => $menu->id,
					        		'role_id' => $firstRole->id,
					        		'action_id' => $action->first()->id
				        		]);	
			        		}	        	
		        		}
        	
        			}
        		/* **************** */	
        		DB::commit();
        			
        } catch (Exception $e) {
        		DB::rollback();
        		dd('Failed With Error : '.$e->getMessage());
        }
        
    }
}
