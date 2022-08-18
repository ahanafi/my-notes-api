<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::query()
            ->select('id')
            ->orderByRaw(DB::raw('RAND()'))
            ->first();

        return [
            'user_id' => $user->id,
            'title' => fake()->sentence(8),
            'body' => fake()->paragraph(15),
            'is_archived' => fake()->boolean()
        ];
    }
}
