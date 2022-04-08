<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Branch;
use App\Forgender;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Branch::create([
            'branch_name'=>'Main Branch',
            'branch_address'=>'Main Branch',
            'branch_phone'=>'021904844'
        ]);

        User::create([
            'branch_id'=>'1',
            'role_id'=>'1',
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('pintinlin')
        ]);

        // User::create([
        //     'role_id'=>'2',
        //     'name'=>'Patient',
        //     'email'=>'patient@gmail.com',
        //     'password'=>bcrypt('pintinlin')
        // ]);

        // User::create([
        //     'role_id'=>'3',
        //     'name'=>'Cashier',
        //     'email'=>'cashier@gmail.com',
        //     'password'=>bcrypt('pintinlin')
        // ]);

        Forgender::create([
            'id'=>'1',
            'gender_name'=>'Male',
        ]);
        Forgender::create([
            'id'=>'2',
            'gender_name'=>'Female',
        ]);
        Forgender::create([
            'id'=>'3',
            'gender_name'=>'Infants',
        ]);
    }
}
