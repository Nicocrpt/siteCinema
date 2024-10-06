<?php

namespace Database\Factories;

use App\Models\Pays;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prenom = fake('fr_FR')->firstName();
        $name = fake('fr_FR')->lastName();

        $pays = rand(1, Pays::all()->count());


        return [
            'nom' => $name,
            'prenom' => $prenom,
            'email' => fake('fr_FR')->safeEmail(),
            'email_verified_at' => now(),
            'telephone' => fake('fr_FR')->phoneNumber(),
            'adresse' => fake('fr_FR')->streetAddress(),
            'code_postal' => fake('fr_FR')->postcode(),
            'ville' => fake('fr_FR')->city(),
            'pays_id' => $pays,
            'statut_abo' => rand(0, 1),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
