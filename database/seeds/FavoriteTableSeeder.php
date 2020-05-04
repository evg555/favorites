<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = [];

        for ($i = 1; $i < 50; $i++) {
            $favorites[] = [
                'url' => "http://test{$i}.ru",
                'title' => "Название #{$i}",
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('favorites')->insert($favorites);
    }
}
