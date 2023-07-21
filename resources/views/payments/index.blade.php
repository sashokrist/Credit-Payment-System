@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Плащания</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Кредит номер</th>
                                <th>Име на получателя</th>
                                <th>Сума (BGN)</th>
                                <th>Период (месеци)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->loan->id }}</td>
                                    <td>{{ $payment->loan->borrower_name }}</td>
                                    <td>{{ $payment->loan->amount }} лв.</td>
                                    <td>{{ $payment->loan->term }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $payments->links('pagination::bootstrap-4') }}
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
