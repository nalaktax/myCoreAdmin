<?php

use Illuminate\Database\Seeder;

class AcctionDefaultSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
