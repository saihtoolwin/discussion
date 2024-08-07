<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['slug' => Str::slug('Web Development'), 'name' => 'Web Development'],
            ['slug' => Str::slug('Mobile Development'), 'name' => 'Mobile Development'],
            ['slug' => Str::slug('UI/UX Design'), 'name' => 'UI/UX Design'],
            ['slug' => Str::slug('SEO'), 'name' => 'SEO'],
            ['slug' => Str::slug('Cloud Computing'), 'name' => 'Cloud Computing'],
        ];
    
        Tag::insert($tags);
    }
}
