<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
	    $role_employee->name = 'author';
	    $role_employee->description = 'Author User';
	    $role_employee->save();

	    $role_admin = new Role();
	    $role_admin->name = 'admin';
	    $role_admin->description = 'Admin User';
        $role_admin->save();
        
        $role_super_admin = new Role();
	    $role_super_admin->name = 'super_admin';
	    $role_super_admin->description = 'Super Admin User';
	    $role_super_admin->save();
    }
}
