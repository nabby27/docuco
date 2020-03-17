<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsTagsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('documents_tags')->truncate();
    // DB::table('documents_tags')->insert([
    // [
    // 'document_id' => 1,
    // 'tag_id' => 1,
    // 'created_at' => date('2019/02/27'),
    // 'updated_at' => date('2019/02/27')
    // ],
    // [
    // 'document_id' => 2,
    // 'tag_id' => 2,
    // 'created_at' => date('2019/02/27'),
    // 'updated_at' => date('2019/02/27')
    // ],
    // [
    // 'document_id' => 3,
    // 'tag_id' => 3,
    // 'created_at' => date('2019/02/27'),
    // 'updated_at' => date('2019/02/27')
    // ],
    // [
    // 'document_id' => 4,
    // 'tag_id' => 1,
    // 'created_at' => date('2019/02/27'),
    // 'updated_at' => date('2019/02/27')
    // ],
    // [
    // 'document_id' => 5,
    // 'tag_id' => 2,
    // 'created_at' => date('2019/02/27'),
    // 'updated_at' => date('2019/02/27')
    // ],
    // [
    // 'document_id' => 6,
    // 'tag_id' => 3,
    // 'created_at' => date('2019/02/27'),
    // 'updated_at' => date('2019/02/27')
    // ],
    // ]);
  }
}
