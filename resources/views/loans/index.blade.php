@extends('layouts.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal"> Плати
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Кредит Система</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-center">Плати</h2>
                                        <form action="{{ route('payments.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="loan_id">Избери кредит:</label>
                                                <select class="form-control" id="loan_id" name="loan_id" required>
                                                    <option value="" selected disabled>Избери кредит от списъка</option>
                                                    @foreach ($loans as $loan)
                                                        <option value="{{ $loan->id }}">{{ $loan->borrower_name }} - BGN {{ $loan->amount }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Сума (BGN):</label>
                                                <input type="number" class="form-control" id="amount" name="amount" min="1" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Плати</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
