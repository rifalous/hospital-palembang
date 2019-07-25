<?php

use Illuminate\Database\Seeder;
use App\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // check if table roles is empty
        if(DB::table('roles')->get()->count() == 0){

            DB::table('roles')->insert(
                [
                    'name' => 'admin',
                    'display_name' => 'Admin',
                    'description' => 'Admin'
                ]
            );

        } else { echo "\eTable is not empty."; }

    }
}

