<?php

use Illuminate\Database\Seeder;
use App\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // check if table permissions is empty
        if(DB::table('permissions')->get()->count() == 0){

            DB::table('permissions')->insert([
                [
                    'parent_id' => 0,
                    'name' => 'dashboard',
                    'display_name' => 'Dashboard',
                    'description' => 'Dashboard'
                ],                [
                    'parent_id' => 0,
                    'name' => 'users',
                    'display_name' => 'Users',
                    'description' => 'Users'
                ]
            ]);

        } else { echo "\eTable is not empty."; }

    }
}

