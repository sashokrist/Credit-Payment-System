@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Кредити</h1>
                        @if ($loans->isEmpty())
                            <p class="text-center">No records found.</p>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Кредит ID</th>
                                    <th>Име на получателя</th>
                                    <th>Сума (BGN)</th>
                                    <th>Месечна вноска (BGN)</th>
                                    <th>Период (месеци)</th>
                                    <th>Лихва (BGN)</th>
                                    <th>Плати</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($loans as $loan)
                                    <tr class="{{ $loan->amount == 0 ? 'table-success' : 'table-danger' }}">
                                        <td>{{ $loan->id }}</td>
                                        <td>{{ $loan->borrower_name }}</td>
                                        <td>{{ $loan->amount }} лв.</td>
                                        <td>
                                            @php
                                                // Calculate monthly installment using the LoanService
                                                $loanService = app(\App\Services\LoanService::class);
                                                $monthlyInstallment = $loanService->calculateMonthlyPayment($loan->amount, $loan->term);
                                                echo number_format($monthlyInstallment, 2);
                                            @endphp лв.
                                        </td>
                                        <td>{{ $loan->term }}</td>
                                        <td>
                                            @php
                                                // Calculate monthly installment using the LoanService
                                                $loanService = app(\App\Services\LoanService::class);
                                                $monthlyInstallment = $loanService->calculateMonthlyInstallment($loan->amount, $loan->term);
                                                echo number_format($monthlyInstallment, 2);
                                            @endphp лв.
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary"
                                                    onclick="openPaymentModal('{{ $loan->id }}', '{{ $loan->borrower_name }}')"> Плати
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $loans->links('pagination::bootstrap-4')}}
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <!-- Modal content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 9000);
    </script>
@endsection
