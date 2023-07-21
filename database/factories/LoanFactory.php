<?php

// database/factories/LoanFactory.php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'borrower_name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(1000, 50000),
            'term' => $this->faker->numberBetween(3, 120),
        ];
    }
}
