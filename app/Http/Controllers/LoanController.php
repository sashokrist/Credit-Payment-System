<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Services\LoanService;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;

class LoanController extends Controller
{
    private $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $loans = Loan::orderByDesc('created_at')->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(LoanRequest $request)
    {
        try {
            // Convert the borrower_name to lowercase
            $request->merge(['borrower_name' => strtolower($request->borrower_name)]);

            // Check if the total amount of loans for the borrower exceeds BGN 80,000
            $isTotalLoansAmountValid = $this->loanService->checkTotalLoansAmount($request->borrower_name, $request->amount);

            if (!$isTotalLoansAmountValid) {
                return redirect()->back()->with('error', 'The total amount of loans for this borrower exceeds BGN 80,000.');
            }

            $loan = Loan::create($request->all());

            return redirect()->route('loans.index')->with('success', 'Вие успешно взехте заем.');
        } catch (Throwable $e) {
            Log::critical($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the loan.');
        }
    }
}
