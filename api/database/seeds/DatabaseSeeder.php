<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
    public function run()
    {
        $this->call([
        TypesTableSeeder::class,
        TagsTableSeeder::class,
        RolesTableSeeder::class,
        UserGroupsTableSeeder::class,
        UsersTableSeeder::class,
        DocumentsTableSeeder::class,
        DocumentsTagsTableSeeder::class
        ]);
    }
}
