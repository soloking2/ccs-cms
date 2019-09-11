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
      //uncomment this to use the UsersTableSeeder
         $this->call(UsersTableSeeder::class);
          $this->call(PostsTableSeeder::class);
    }
}
