<?php

// database/seeders/LoanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;

class LoanSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Loan::factory(10)->create();
    }
}
