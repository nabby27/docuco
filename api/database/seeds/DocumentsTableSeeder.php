<?php

use Illuminate\Database\Seeder;

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
                'name' => 'Factura de luz',
                'description' => 'Factura de luz de junio 2019',
                'price' => 24.20,
                'url' => 'https://url.1.2019_06_10_documento_luz.pdf',
                'dateOfIssue' => '2019/06/10',
                'users_group_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Factura de agua',
                'description' => 'factura de agua de junio 2019',
                'price' => 15.10,
                'url' => 'https://url.1.2019_06_05_documento_agua.pdf',
                'dateOfIssue' => '2019/06/5',
                'users_group_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Factura de internet',
                'description' => 'factura de internet de junio 2019',
                'price' => 62.83,
                'url' => 'https://url.1.2019_06_02_documento_internet.pdf',
                'dateOfIssue' => '2019/06/2',
                'users_group_id' => 1,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Factura de luz',
                'description' => 'factura de luz de junio 2019',
                'price' => 52.32,
                'url' => 'https://url.2.2019_06_11_documento_luz.pdf',
                'dateOfIssue' => '2019/06/11',
                'users_group_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Factura de agua',
                'description' => 'factura de agua de junio 2019',
                'price' => 9.74,
                'url' => 'https://url.2.2019_06_08_documento_agua.pdf',
                'dateOfIssue' => '2019/06/8',
                'users_group_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Factura de internet',
                'description' => 'factura de internet de junio 2019',
                'price' => 73.21,
                'url' => 'https://url.2.2019_06_02_documento_internet.pdf',
                'dateOfIssue' => '2019/06/2',
                'users_group_id' => 2,
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
        ]);
    }
}
