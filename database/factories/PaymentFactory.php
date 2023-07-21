<?php

// database/factories/PaymentFactory.php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'loan_id' => function () {
                return \App\Models\Loan::factory()->create()->id;
            },
            'amount' => $this->faker->numberBetween(50, 500),
        ];
    }
}
