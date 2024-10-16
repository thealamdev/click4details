@extends('layouts.master')
@section('title', 'Accessory Orders')
@section('content')
    <div class="container-fluid">

        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-10 col-xl-10">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-header px-4 py-5">
                                <h5 class="text-muted mb-0">Thanks for your Order, <span
                                        style="color: #a8729a;">{{ $order_details->client->name }}</span>!</h5>
                                @if ($order_details->payment_status == 'paid')
                                    <img src="https://clipart-library.com/new_gallery/71-716884_image-stamp-png-transparent-svg-onlygfx-com-transparent.png"
                                        alt="Paid"
                                        style="position: absolute;top:10px;right:10px;height:auto;width:100px;z-index:1">
                                @else
                                    <img src="https://static.vecteezy.com/system/resources/previews/022/412/375/original/unpaid-rubber-stamp-red-unpaid-rubber-grunge-stamp-seal-illustration-vector.jpg"
                                        alt="unpaid"
                                        style="position: absolute;top:10px;right:10px;height:auto;width:100px;z-index:1">
                                @endif

                            </div>

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
                                    <p class="small text-muted mb-0">Receipt Voucher : {{ $order_details->transaction_id }}
                                    </p>
                                </div>
                                @foreach ($order_details->card_order as $each)
                                    <div class="card shadow-0 border mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('storage/accessories/' . $each?->image) }}"
                                                        alt="Phone" width="100px" height="80px">
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">{{ $each?->title }}</p>
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{ 'Qty: ' . $each?->quantity }}</p>
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">
                                                        {{ $each?->unit_price . ' * ' . $each?->quantity }}</p>
                                                </div>

                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{ $each?->sub_total . ' TK' }}</p>
                                                </div>
                                            </div>
                                            <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                        </div>
                                    </div>
                                @endforeach



                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">Order Details</p>
                                    <p class="text-muted mb-0"><span
                                            class="fw-bold me-4">Total</span>{{ collect($order_details->card_order)->sum('sub_total') }}
                                        <span>TK</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0">Invoice Number : {{ '#' . $order_details->id }}</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span>00 TK</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Invoice Date :
                                        {{ date_format($order_details->created_at, 'd M Y') }}</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">GST 0%</span> 0 TK</p>
                                </div>

                                <div class="d-flex justify-content-between mb-5">
                                    <p class="text-muted mb-0">Recepits Voucher : {{ $order_details->transaction_id }}</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span>
                                        {{ $order_details->shipping_charge }} <span>TK</span></p>
                                </div>
                            </div>
                            <div class="card-footer border-0 px-4 py-5"
                                style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                                    Remain
                                    : <span class="h2 mb-0 ms-2">{{ $order_details->payable_amount . ' TK' }}</span>
                                    <h5
                                        class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                                        Paid :
                                        : <span class="h2 mb-0 ms-2">{{ $order_details->payment . ' TK' }}</span>
                                    </h5>
                                    <hr>
                                    <h3
                                        class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                                        Due : <span class="h2 mb-0 ms-2">
                                            {{ $order_details->payable_amount - $order_details->payment . ' Tk' }} </span>
                                    </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
