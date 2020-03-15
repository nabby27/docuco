<?php

use Docuco\Domain\Users\Constants\RoleConstants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
        [
        'name' => RoleConstants::ADMIN,
        'description' => 'can view, edit and manage documents, data and other users',
        'created_at' => date('2019/02/27'),
        'updated_at' => date('2019/02/27')
        ],
        [
        'name' => RoleConstants::EDIT,
        'description' => 'can only view and edit documents and data, cannot manage other users',
        'created_at' => date('2019/02/27'),
        'updated_at' => date('2019/02/27')
        ],
        [
        'name' => RoleConstants::VIEW,
        'description' => 'can only view documents and data',
        'created_at' => date('2019/02/27'),
        'updated_at' => date('2019/02/27')
        ]
        ]);
    }
}
