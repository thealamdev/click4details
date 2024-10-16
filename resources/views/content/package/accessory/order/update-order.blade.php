@extends('layouts.master')
@section('title', 'Update Order Status')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Order Status of Accessory</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{route('admin.accessory.order.updateOrderStatus',['order' => $updateOrderStatus->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 m-auto">
                        <div class="form-group mb-3">
                            <label class="form-label fw-500 mb-1" for="payment">Payment<span
                                    class="ms-1 text-red-600">*</span></label>
                             <select name="order_status" class="form-control">
                                <option value="">-- Select a Option --</option>
                                <option value="pending" {{$updateOrderStatus->order_status == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="processing" {{$updateOrderStatus->order_status == 'processing' ? 'selected' : ''}}>Processing</option>
                                <option value="complete" {{$updateOrderStatus->order_status == 'complete' ? 'selected' : ''}}>Complete</option>
                                <option value="cancel" {{$updateOrderStatus->order_status == 'cancel' ? 'selected' : ''}}>Cancel</option>
                             </select>
                        </div>

                        <div class="mt-4">
                            <button  type="submit" class="btn btn-dark border-0">
                                <i class="fa-solid fa-plus me-1"></i>Confirm
                            </button>
                            <a href="{{ route('admin.accessory.order.index') }}" class="btn btn-default">
                                <i class="fa-solid fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
