<?php

use Illuminate\Database\Seeder;

class DocumentsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents_types')->truncate();
        DB::table('documents_types')->insert([
            [
                'document_id' => 1,
                'type_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'document_id' => 2,
                'type_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'document_id' => 3,
                'type_id' => 3,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'document_id' => 4,
                'type_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'document_id' => 5,
                'type_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'document_id' => 6,
                'type_id' => 3,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
        ]);
    }
}
