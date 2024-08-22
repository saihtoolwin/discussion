<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
   
    public function definition(): array
    {
        $title = $this->faker->sentence;
    
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'is_fixed' => $this->faker->boolean ? 'true' : 'false',
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
