@extends('layouts.master')
@section('title', 'Create Vehicle')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Customer Care Infos</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('merchant.customer-care.update', ['customerCare' => $customerCare?->id]) }}"
                    method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="row gx-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="name">Name<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control @error('name') {{ 'is-invalid' }} @enderror"
                                    name="name" value="{{ old('name', $customerCare?->name) }}" required />
                                @error('name')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="email">Email<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="email" class="form-control @error('email') {{ 'is-invalid' }} @enderror"
                                    name="email" value="{{ old('email', $customerCare?->email) }}" required />
                                @error('email')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="mobile">Mobile<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="number" class="form-control @error('mobile') {{ 'is-invalid' }} @enderror"
                                    name="mobile" value="{{ old('mobile', $customerCare?->mobile) }}" required />
                                @error('mobile')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm
                        </button>
                        <a href="{{ route('merchant.customer-care.index') }}" class="btn btn-default">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
