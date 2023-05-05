<?php

namespace Database\Factories\Statement;

use Carbon\Carbon;
use App\Models\Statement\Statement;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatementFactory extends Factory
{
    protected $model = Statement::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];
    }
}
