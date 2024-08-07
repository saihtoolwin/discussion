<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionTags = [
            ['question_id' => 1, 'tag_id' => 1],
            ['question_id' => 1, 'tag_id' => 3],
            ['question_id' => 2, 'tag_id' => 2],
            ['question_id' => 2, 'tag_id' => 3],
            ['question_id' => 3, 'tag_id' => 4],
            ['question_id' => 4, 'tag_id' => 4],
            ['question_id' => 5, 'tag_id' => 5],
        ];

        DB::table('question_tags')->insert($questionTags);
    }
}
