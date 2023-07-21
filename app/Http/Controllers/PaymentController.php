<?php

namespace App\Http\Controllers;

use App\Exceptions\PaymentException;
use App\Http\Requests\PaymentRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function createPayment()
    {
        $loans = Loan::orderByDesc('created_at')->get();
        return view('payments.create', compact('loans'));
    }

    public function store(PaymentRequest $request)
    {
        try {
            $loan = Loan::findOrFail($request->loan_id);
        } catch (Throwable $e) {
            Log::critical($e->getMessage());
            return redirect()->back()->with('error', 'Loan not found.');
        }

        try {
            $paymentSuccessful = $this->paymentService->makePayment($loan, $request->amount);
            return redirect()->route('loans.index')->with('success', 'Payment made successfully.');
        } catch (Throwable $e) {
            if ($e instanceof(PaymentException::class)){
                Log::critical($e->getMessage());
                return redirect()->back()->with('warning', $e->getMessage());
            } else {
                Log::critical($e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while making the payment.');
            }
        }
    }
}
