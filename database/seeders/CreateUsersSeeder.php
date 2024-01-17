<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'first_name' => 'ธิติพัทธ์',
                'last_name' => 'คำดีพรสวัสดิ์',
                'email' => 'admin@gmail.com',
                'status' => 'active',
                'role_user' => 'admin',
                'password' => bcrypt('1234'),
            ],
            [
                'first_name' => 'การันต์',
                'last_name' => 'หงษ์ทอง',
                'email' => 'employee@gmail.com',
                'status' => 'active',
                'role_user' => 'employee',
                'password' => bcrypt('1234'),
            ],
            [
                'first_name' => 'สุทธิพงษ์',
                'last_name' => 'เหล่าอรุณ',
                'email' => 'employee2@gmail.com',
                'status' => 'active',
                'role_user' => 'employee',
                'password' => bcrypt('1234'),
            ],
            [
                'first_name' => 'บริวัตร',
                'last_name' => 'จันทรทรัพย์',
                'email' => 'employee3@gmail.com',
                'status' => 'active',
                'role_user' => 'employee',
                'password' => bcrypt('1234'),
            ]
            ];

            foreach($user as $key => $value){
                User::create($value);
            }
    }
}
