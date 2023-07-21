<?php

namespace App\Services;

use App\Exceptions\PaymentException;
use App\Models\Loan;
use App\Models\Payment;
use http\Exception\RuntimeException;

class PaymentService
{
    /**
     * Check if the total amount of loans for the borrower exceeds BGN 80,000
     *
     * @param string $borrowerName
     * @param float $loanAmount
     * @return bool
     */
    public function makePayment(Loan $loan, $amountToBePaid)
    {
        // Calculate the remaining amount due for the loan
        $remainingAmount = $loan->amount;

        if ($amountToBePaid > $remainingAmount) {
            $remainingAmount = $amountToBePaid - $remainingAmount;
            $loan->amount = 0;
            $loan->save();
            throw new PaymentException(sprintf('Вие платих те (%d) лв. повече от колкото дължите сумата ще ви бъде приспадната и остатъка ввърнат! Сума за получаване: (%d) лв. ',
                $amountToBePaid, $remainingAmount ));
        }
        $loan->amount = $remainingAmount - $amountToBePaid;
        $loan->save();
    }
}
