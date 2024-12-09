<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LetterType>
 */
class LetterTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['Surat Keputusan','Surat Peringatan','Surat Pemberitahuan','Surat Kontrak Kerjasama']),
            'code' => fake()->randomElement(['SK','SP','SPb','SKo']),
            'number' => mt_rand(100, 999),
            'ordinal' => '0000'
        ];
    }
}
