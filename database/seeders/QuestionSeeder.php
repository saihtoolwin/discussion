<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'user_id' => 1, 
                'title' => 'How to learn Laravel?',
                'slug' => Str::slug('How to learn Laravel?'),
                'description' => 'I want to learn Laravel. What are the best resources to start with?',
                'is_fixed' => 'false',
            ],
            [
                'user_id' => 2, 
                'title' => 'Best practices for Vue.js?',
                'slug' => Str::slug('Best practices for Vue.js?'),
                'description' => 'Can someone share the best practices for developing applications with Vue.js?',
                'is_fixed' => 'false',
            ],
            [
                'user_id' => 1, 
                'title' => 'Understanding RESTful APIs',
                'slug' => Str::slug('Understanding RESTful APIs'),
                'description' => 'What are RESTful APIs and how do they work?',
                'is_fixed' => 'false',
            ],
            [
                'user_id' => 3, 
                'title' => 'Tips for optimizing SQL queries',
                'slug' => Str::slug('Tips for optimizing SQL queries'),
                'description' => 'How can I optimize my SQL queries for better performance?',
                'is_fixed' => 'false',
            ],
            [
                'user_id' => 4, 
                'title' => 'Getting started with Docker',
                'slug' => Str::slug('Getting started with Docker'),
                'description' => 'What is Docker and how can I get started with it?',
                'is_fixed' => 'false',
            ],
        ];

        DB::table('questions')->insert($questions);
    }
}
