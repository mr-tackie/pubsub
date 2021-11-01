<?php

namespace Database\Seeders;

use App\Models\Topic\Topic;
use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create([
            "id" => "topic1"
        ]);

        Topic::create([
            "id" => "topic2"
        ]);

        Topic::create([
            "id" => "topic3"
        ]);
    }
}
