<?php

namespace App\Services;

use App\Exceptions\PaymentException;
use App\Models\Loan;
use App\Models\Payment;
use RuntimeException;

class PaymentService
{
    private $loanService;

    // function __construct(argument) to load LoanService
    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }
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
        //dd($remainingAmount);
        // call calculateMonthlyPayment function from LoanService and save to variable
        $monthlyPayment = $this->loanService->calculateMonthlyPayment($loan->amount, $loan->term);

        // check if amountToBePaid is less than monthlyPayment
        if ($amountToBePaid < $monthlyPayment) {
            throw new PaymentException(sprintf('Сумата за плащане трябва да е поне %d лв.', $monthlyPayment));
        }

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
