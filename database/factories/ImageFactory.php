<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imagesDirectory = 'public/images';

        // ディレクトリがなければ作成する
        if (!Storage::exists($imagesDirectory)) {
            Storage::makeDirectory($imagesDirectory);
        }
        return [
            'name' => $this->faker->image(
                dir: storage_path('app/public/images'), 
                fullPath: false
            )
        ];
    }
}
