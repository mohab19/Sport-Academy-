<?php

use Illuminate\Database\Seeder;

class PostsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\models\PostType::create([
            "title"=>"Public",
        ]);
        \App\models\PostType::create([
            "title"=>"Private",
        ]);
    }
}
