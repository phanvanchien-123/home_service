<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $service_name = $this->faker->unique()->word($nb=4,$astext=true);
        $slug= Str::slug($service_name,"-");
        $image ='service_'.$this->faker->unique()->numberBetween(1,20).'.jpg';
        return [
            'name'=>$service_name,
            'slug'=>$slug,
            'tagline'=>$this->faker->text(20),
            'service_category_id'=>$this->faker->numberBetween(1,10),
            'price'=>$this->faker->numberBetween(1000,5000),
            'image'=>$image,
            'thumbnail'=>$image,
            'description'=>$this->faker->text(500),
            'inclusion'=>$this->faker->text(20).'|'.$this->faker->text(20),
            'exclusion'=>$this->faker->text(20).'|'.$this->faker->text(20),
        ];
    }
}
