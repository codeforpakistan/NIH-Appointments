<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Department::class, 10)->create();

        $departments = App\Department::all();
        foreach ($departments as $department) {
		    $department->hospitals()->attach(App\Hospital::all()->random(5));
        }
    }
}
