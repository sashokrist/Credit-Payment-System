<?php

// app/Services/LoanService.php

namespace App\Services;

use App\Models\Loan;

class LoanService
{
    /**
     * Calculate the annual interest for a loan amount.
     *
     * @param float $loanAmount The loan amount.
     * @return float The calculated annual interest.
     */
    public function calculateMonthlyInstallment($loanAmount)
    {
        $annualInterestRate = 0.079; // 7.9% annual interest rate

        // Calculate the annual interest amount
        $annualInterest = $loanAmount * $annualInterestRate;

        return $annualInterest;
    }

    /**
     * Calculate the monthly payment amount for a loan.
     *
     * @param float $loanAmount The loan amount.
     * @param int $loanTermMonths The loan term in months.
     * @return float The calculated monthly payment amount.
     */
    public function calculateMonthlyPayment($loanAmount, $loanTermMonths)
    {
        $annualInterestRate = 0.079; // 7.9% annual interest rate
        $monthlyInterestRate = $annualInterestRate / 12; // Convert annual interest rate to monthly interest rate

        // Calculate the monthly payment amount using the formula for a fixed-rate loan payment
        $denominator = 1 - pow(1 + $monthlyInterestRate, -$loanTermMonths);

        // Check if the denominator is zero (infinite installment amount) to avoid division by zero
        if ($denominator === 0) {
            return 0;
        }

        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / $denominator;
        return round($monthlyPayment, 2); // Round to 2 decimal places
    }

    /**
     * Check if the total amount of loans for the borrower exceeds BGN 80,000
     *
     * @param $borrowerName
     * @param $loanAmount
     * @return bool
     */
    public function checkTotalLoansAmount($borrowerName, $loanAmount)
    {
        $totalAmountLoans = Loan::where('borrower_name', $borrowerName)->sum('amount');

        return $totalAmountLoans + $loanAmount <= 80000;
    }
}
