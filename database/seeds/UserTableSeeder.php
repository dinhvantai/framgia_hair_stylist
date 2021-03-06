<?php

use Illuminate\Database\Seeder;
use App\Eloquents\Department;
use App\Eloquents\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataUserAdmin = [
            'email' =>  'admin@gmail.com',
            'name' =>  'Admin',
            'password' =>  'admin123',
            'phone' =>  '01234567899',
            'permission' =>  User::PERMISSION_ADMIN,
        ];
        User::create($dataUserAdmin);

        $department = Department::first();
        $dataUser = [
            'password' =>  'user123',
            'permission' =>  User::PERMISSION_MAIN_WORKER,
            'department_id' => $department ? $department->id : '',
        ];
        for ($i=0; $i < 3; $i++) { 
            $dataUser['email'] = 'main.worker' . $i . '@gmail.com';
            $dataUser['name'] = 'Main Worker ' . $i;
            $dataUser['phone'] = '0123456789' . $i;
            User::create($dataUser);
        }
    }
}
