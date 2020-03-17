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
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ],
      [
        'name' => 'Tony',
        'email' => 'tony_example@gmail.com',
        'password' => bcrypt('123456'),
        'role_id' => 2,
        'user_group_id' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ],
      [
        'name' => 'Alejandro',
        'email' => 'alejandro_example@gmail.com',
        'password' => bcrypt('123456'),
        'role_id' => 3,
        'user_group_id' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ],
      [
        'name' => 'Victor',
        'email' => 'victor_example@gmail.com',
        'password' => bcrypt('123456'),
        'role_id' => 1,
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ],
      [
        'name' => 'Sergio',
        'email' => 'sergio_example@gmail.com',
        'password' => bcrypt('123456'),
        'role_id' => 2,
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ],
      [
        'name' => 'Miguel',
        'email' => 'miguel_example@gmail.com',
        'password' => bcrypt('123456'),
        'role_id' => 3,
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ]
    ]);
  }
}
