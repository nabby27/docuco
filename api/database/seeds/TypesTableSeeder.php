<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('types')->truncate();
    DB::table('types')->insert([
      [
        'name' => 'INCOME'
      ],
      [
        'name' => 'EXPENSE'
      ]
    ]);
  }
}
