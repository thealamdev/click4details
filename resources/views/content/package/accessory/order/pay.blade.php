@extends('layouts.master')
@section('title', 'Clear Payment')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Clear Payment</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{route('admin.accessory.order.dopay',['order' => $pays->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 m-auto">
                        <div class="form-group mb-3">
                            <label class="form-label fw-500 mb-1" for="payment">Payment<span
                                    class="ms-1 text-red-600">*</span></label>
                            <input type="number" min="1" max="{{ $pays->due }}" class="form-control" name="payment"
                                value="{{ $pays->due }}" {{$pays->due == 0 ? 'disabled' : ''}} required />
                            @error('payment')
                                <div class="invalid-feedback text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button {{$pays->due == 0 ? 'disabled' : ''}} type="submit" class="btn btn-dark border-0">
                                <i class="fa-solid fa-plus me-1"></i>Confirm & Next
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
