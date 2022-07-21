<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,3),
            'cs_id' => 1,
            'category_id' => rand(1,5),
            'status' => rand(0,1),
            'title' => fake()->sentence(10),
            'slug' => fake()->sentence(10),
            'cover' => 'cover-image/XsNQLor2Y38W8DKUDJ92ICx23wTxEHDEewZBCQwU.jpg',
            'target' => rand(100000000,1000000000),
            'end_date' => fake()->date(),
            'caption' => fake()->sentence(20),
            'description' => fake()->paragraph(200),
        ];
    }
}
