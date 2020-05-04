<?php

use Illuminate\Database\Seeder;
use App\Favorite;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(FavoriteTableSeeder::class);
        factory(Favorite::class, 50)->create();
    }
}
