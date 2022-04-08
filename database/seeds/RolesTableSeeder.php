<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Role::create([
            'role_name'=>'Admin',
            'role_slug'=>'admin',
        ]);

        
        Role::create([
            'role_name'=>'Patient',
            'role_slug'=>'patient',
        ]);

        
        Role::create([
            'role_name'=>'Cashier',
            'role_slug'=>'cashier',
        ]);
    }
}
