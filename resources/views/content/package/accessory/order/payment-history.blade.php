@extends('layouts.master')
@section('title', 'Accessory Orders')
@section('content')
    <div class="container-fluid">
        <div class="card rounded border">
            <div class="card-header">
                <h5>Payment History of <span class="text-primary">{{ $payment_history->client->name }}</span></h5>
                <p>Transcation ID : <span class="text-primary">{{ $payment_history->transaction_id }}</span></p>
                <p>Payable amount: <span class="text-success">{{ $payment_history->payable_amount }}</span> <span>tk</span>
                </p>
                <hr>
                <p>Due : <span class="text-primary font-weight-bold">{{ $payment_history->due }}</span><span> tk</span></p>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <th>SL</th>
                <th>Date</th>
                <th>Amount</th>
            </thead>

            <tbody>
                @foreach ($payment_history->payments as $each)
                    <tr>
                        <td>{{ $each?->id }}</td>
                        <td>{{ date_format($each?->created_at, 'd-M-Y') }}</td>
                        <td>{{ $each?->pay }} <span>tk</span></td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <td colspan="2"></td>
                <td>Total : {{ collect($payment_history->payments)->sum('pay') }} <span>tk</span></td>
            </tfoot>
        </table>

        <div class="mt-4">
            <a href="{{ route('admin.accessory.order.index') }}" class="btn btn-default">
                <i class="fa-solid fa-arrow-left me-1"></i>Back
            </a>

            <a href="{{ route('admin.accessory.order.pay', ['order' => $payment_history->id]) }}"
                class="btn btn-info" title="Payment"><i class="fa-solid fa-sack-dollar"></i></a>
        </div>
    </div>
@endsection
