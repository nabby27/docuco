<?php

use Illuminate\Database\Seeder;

class UsersGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_groups')->truncate();
        DB::table('users_groups')->insert([
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
