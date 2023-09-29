<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(rand(10,40));
        $short_title = Str::length($title) > 30 ? mb_substr($title, 0, 30) .'...' : $title;
        $created = fake()->dateTimeBetween('-30 days', '-1 days');
        return [
            'title' => $title,
            'short_title'=> $short_title,
            'author_id' => rand(1,4),
            'description'=>fake()->realText(100, 2),
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}
