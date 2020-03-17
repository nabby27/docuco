<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('user_groups')->truncate();
    DB::table('user_groups')->insert([
      [
        'name' => 'Green Urban Data',
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ],
      [
        'name' => 'Belike Software',
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ]
    ]);
  }
}
