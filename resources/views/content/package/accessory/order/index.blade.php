@extends('layouts.master')
@section('title', 'Accessory Orders')
@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-2">Accessory Orders</h4>
            </div>
        </div>

        <div class="card rounded border border-gray-300 mb-2">
            <div class="card-body">
                <form action="{{ route('admin.accessory.order.index') }}" method="GET">
                    <div class="row">
                        {{-- <div class="col-lg-2">
                            <input type="text" name="client_name" placeholder="Search by Name" class="form-control">
                        </div> --}}

                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="transaction_id"
                                placeholder="Seach by Transaction ID" class="form-control"
                                value="{{ request()->transaction_id }}">
                        </div>

                        <div class="col-lg-2">
                            <select name="payment_status" class="form-control">
                                <option value="">-- Select Payment Status --</option>
                                <option value="paid" {{ request()->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                                <option value="unpaid" {{ request()->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                                <option value="partical" {{ request()->payment_status == 'partical' ? 'selected' : '' }}>
                                    Partical</option>
                                <option value="due" {{ request()->payment_status == 'due' ? 'selected' : '' }}>
                                    Due</option>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <select name="order_status" class="form-control">
                                <option value="">-- Select Order Status --</option>
                                <option value="pending" {{ request()->order_status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ request()->order_status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="complete" {{ request()->order_status == 'complete' ? 'selected' : '' }}>
                                    Complete</option>
                                <option value="cancel" {{ request()->order_status == 'cancel' ? 'selected' : '' }}>Cancel
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <input type="date" name="start_date" class="form-control"
                                value="{{ request()->start_date }}">
                        </div>

                        <div class="col-lg-2">
                            <input type="date" name="end_date" class="form-control" value="{{ request()->end_date }}">
                        </div>

                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-success w-100">Search</button>
                                </div>

                                <div class="col-lg-6">
                                    <a href="{{ route('admin.accessory.order.index') }}"><button type="button"
                                            class="btn btn-danger w-100">Reset</button>
                                    </a>
                                </div>
                            </div>


                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <table id="dataTable" class="table">
                    <thead>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $paid = 0;
                        @endphp
                        @foreach ($orders as $each)
                            @php
                                $paid += $each?->payable_amount - $each?->due;
                            @endphp
                            <tr>
                                <td>{{ $each->id }}</td>
                                <td>{{ $each->client->name }}</td>
                                <td> <span class="value">{{ $each->transaction_id }}</span> &nbsp; <span><i
                                            class="fa-regular fa-copy copy" title="copy"></i></span></td>
                                <td>{{ $each->payable_amount }}<span> tk</span></td>
                                <td>{{ $each?->payable_amount - $each?->due }} <span> tk</span></td>
                                <td>{{ $each?->due }} <span> tk</span></td>
                                <td>
                                    <span
                                        class="@if ($each?->payment_status == 'paid') paid
                                    @elseif($each?->payment_status == 'unpaid')
                                        unpaid
                                    @else
                                        partial @endif">{{ $each->payment_status }}</span>
                                </td>
                                <td>
                                    <span
                                        class="@if ($each?->order_status == 'pending') pending
                                        @elseif($each?->order_status == 'processing')
                                        processing
                                        @elseif($each?->order_status == 'complete')
                                        complete
                                        @else
                                            cancel @endif">{{ $each->order_status }}</span>
                                </td>
                                <td>{{ $each->updated_at->diffForHumans() }}</td>
                                <td>
                                    {{-- <a href="javascript:void(0)" class="btn btn-primary" title="Show Details" id="show"
                                        data-url="{{ route('admin.accessory.order.show', ['order' => $each->id]) }}"><i
                                            class="fa-solid fa-eye"></i></a> --}}
                                    <a href="{{ route('admin.accessory.order.show', ['order' => $each->id]) }}"
                                        class="btn btn-primary" title="Show Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.accessory.order.pay', ['order' => $each->id]) }}"
                                        class="btn btn-info" title="Payment"><i class="fa-solid fa-sack-dollar"></i></a>

                                    <a href="{{ route('admin.accessory.order.updateOrder', ['order' => $each->id]) }}"
                                        class="btn btn-success" title="Update Order Status"><i
                                            class="fa-solid fa-pen"></i></a>

                                    <a href="{{ route('admin.accessory.order.paymentHistory', ['order' => $each->id]) }}"
                                        class="btn btn-warning" title="Payment History"><i
                                            class="fa-solid fa-clock-rotate-left"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td>Total : {{ collect($orders)->sum('payable_amount') }}<span> tk</span></td>
                            <td>Paid: {{ $paid }}<span> tk</span></td>
                            <td>Due: {{ collect($orders)->sum('due') }}<span> tk</span></td>
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="showDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="one"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthMenu": [ [20, 40, 60, 100, -1], [20, 40, 60, 100, "All"] ]
            });
        });
    </script>
@endpush

