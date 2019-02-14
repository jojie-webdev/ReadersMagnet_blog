<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Category();
	    $role_employee->category_name = 'Uncategorized';
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = "Children's book";
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = 'Literature & Fiction & Non-Fiction';
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = 'Christian and Inpirational';
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = 'History';
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = 'Health & Fitness';
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = 'Computers & Technology';
        $role_employee->save();
        
        $role_employee = new Category();
	    $role_employee->category_name = 'Sports & Travel';
	    $role_employee->save();
    }
}
