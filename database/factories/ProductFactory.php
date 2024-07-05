<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->word(rand(1, 3), true);
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'SKU' => fake()->unique()->ean13(),
            'description' => fake()->boolean() ? fake()->sentences(rand(1, 5), true) : null,
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount' => fake()->boolean() ? fake()->numberBetween(1, 100) : null,
            'quantity' => rand(1, 100),
            // 'thumbnail' => 'https://via.placeholder.com/200x250.png',
            'thumbnail' => '',
        ];
    }

    public function withThumbnail(): static
    {
        return $this->state(fn(array $attributes) => [
            'thumbnail' => $this->generateImage($attributes['slug']),
        ]);
    }

    protected function generateImage(string $slug): string
    {
        $dirName = "faker/products/$slug";
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        if (!Storage::exists($dirName)) {
            Storage::createDirectory($dirName);
        }

        /**
         * @var \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider $faker
         */
        return $dirName . '/' . $faker->image(
                dir: Storage::path($dirName),
                isFullPath: false
            );
    }
}
