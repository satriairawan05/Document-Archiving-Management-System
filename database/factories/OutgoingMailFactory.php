<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutgoingMail>
 */
class OutgoingMailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $userId = mt_rand(2, 6),
            'letter_id' => mt_rand(1, 99),
            'subject' => fake()->sentence(5),
            'from' => fake()->company,
            'sender' => fake()->name,
            'receipint' => \App\Models\User::find($userId)->name,
            'date' => \Carbon\Carbon::now()->subDays(rand(1, 30)),
            'document' => function () {
                $sourceDir = storage_path('app/public/Mail');
                $destDir = storage_path('app/public/Mails');

                // Ensure directories exist
                if (!is_dir($sourceDir) || !is_dir($destDir)) {
                    return null; // Return null if directories are missing
                }

                // Generate a file path
                $faker = \Faker\Factory::create();
                return $faker->file($sourceDir, $destDir, false);
            },
            'doc_name' => $this->faker->word . '.pdf', // Nama dokumen dengan format acak
            'doc_extension' => 'pdf',
        ];
    }
}
