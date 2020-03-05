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
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ],
            [
                'name' => 'Belike Software',
                'created_at' => date('2019/02/27'),
                'updated_at' => date('2019/02/27')
            ]
        ]);
    }
}
