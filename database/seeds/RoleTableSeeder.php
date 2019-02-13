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

	    $role_manager = new Role();
	    $role_manager->name = 'admin';
	    $role_manager->description = 'Admin User';
        $role_manager->save();
        
        $role_manager = new Role();
	    $role_manager->name = 'super_admin';
	    $role_manager->description = 'Super Admin User';
	    $role_manager->save();
    }
}
