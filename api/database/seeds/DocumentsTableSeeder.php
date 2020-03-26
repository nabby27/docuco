<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        DB::table('documents')->truncate();
        DB::table('documents')->insert([
        [
        'name' => 'Factura de Jazztel',
        'description' => '',
        'price' => 60.90,
        'url' => '/assets/documents/jazztel_enero.pdf',
        'date_of_issue' => '2020/01/28',
        'user_group_id' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 2
        ],
        [
        'name' => 'Factura de Jazztel',
        'description' => '',
        'price' => 60.90,
        'url' => '/assets/documents/jazztel_febrero.pdf',
        'date_of_issue' => '2020/02/26',
        'user_group_id' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 2
        ],
        [
        'name' => 'Nomina enero',
        'description' => '',
        'price' => 841.78,
        'url' => '/assets/documents/nomina_enero.pdf',
        'date_of_issue' => '2020/01/31',
        'user_group_id' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 1
        ],
        [
        'name' => 'Nomina febrero',
        'description' => '',
        'price' => 1615.28,
        'url' => '/assets/documents/nomina_febrero.pdf',
        'date_of_issue' => '2020/02/29',
        'user_group_id' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 1
        ],
        [
        'name' => 'Factura a Balearia',
        'description' => '',
        'price' => 1963.77,
        'url' => '/assets/documents/balearia.pdf',
        'date_of_issue' => '2020/01/10',
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 1
        ],
        [
        'name' => 'Factura a AVIS',
        'description' => '',
        'price' => 62.68,
        'url' => '/assets/documents/avis.pdf',
        'date_of_issue' => '2020/02/5',
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 1
        ],
        [
        'name' => 'Factura a Enterprise',
        'description' => '',
        'price' => 182.04,
        'url' => '/assets/documents/enterprise.pdf',
        'date_of_issue' => '2019/03/2',
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 1
        ],
        [
        'name' => 'Factura a Fred Olsen',
        'description' => '',
        'price' => 182.04,
        'url' => '/assets/documents/fred_olsen.pdf',
        'date_of_issue' => '2020/04/2',
        'user_group_id' => 2,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
        'type_id' => 1
        ],
        ]);
    }
}
