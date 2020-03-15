<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        DB::table('tags')->truncate();
        DB::table('tags')->insert([
        [
        'name' => 'Luz',
        'description' => 'It refers to expenses generate by light consumption',
        'created_at' => date('2019/02/27'),
        'updated_at' => date('2019/02/27')
        ],
        [
        'name' => 'Agua',
        'description' => 'It refers to expenses generate by water consumption',
        'created_at' => date('2019/02/27'),
        'updated_at' => date('2019/02/27')
        ],
        [
        'name' => 'Internet',
        'description' => 'It refers to expenses generate by internet consumption',
        'created_at' => date('2019/02/27'),
        'updated_at' => date('2019/02/27')
        ]
        ]);
    }
}
