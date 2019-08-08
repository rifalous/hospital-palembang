<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role_user;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name= 'admin';
        $user->email= 'admin@gmail.com';
        $user->password= bcrypt('admin');
        $user->save();

        $role_user = new Role_user;
        $role_user->role_id= 1;
        $role_user->user_id= $user->id;
        $role_user->save();
    }
}
