<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name' => 'Iván',
                'email' => 'icordobadonet@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 1,
                'user_group_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Tony',
                'email' => 'tony_example@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 2,
                'user_group_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Alejandro',
                'email' => 'alejandro_example@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 3,
                'user_group_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Victor',
                'email' => 'victor_example@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 1,
                'user_group_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Sergio',
                'email' => 'sergio_example@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 2,
                'user_group_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Miguel',
                'email' => 'miguel_example@gmail.com',
                'password' => bcrypt('123456'),
                'role_id' => 3,
                'user_group_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ]
        ]);
    }
}
