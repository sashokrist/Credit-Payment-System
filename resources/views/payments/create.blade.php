@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Плати</h2>
                        <form action="{{ route('payments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="loan_id">Select Credit:</label>
                                <select class="form-control" id="loan_id" name="loan_id" required>
                                    <option value="" selected disabled>Избери кредит</option>
                                    @foreach ($loans as $loan)
                                        <option value="{{ $loan->id }}">{{ $loan->borrower_name }} - BGN {{ $loan->amount }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Сума (BGN):</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Плати</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
