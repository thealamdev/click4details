@extends('layouts.master')
@section('title', 'Update Merchant')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Merchant</h4>
                <p>Prior to update resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.merchant.update', ['merchant' => $merchant->id]) }}" method="POST"
                    accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="name">Name<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $merchant->name) }}" required />
                                @error('name')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="email">Email<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $merchant->email) }}" required />
                                @error('email')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="mobile">Mobile<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="tel" class="form-control" name="mobile"
                                    value="{{ old('mobile', $merchant->mobile) }}" required />
                                @error('mobile')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="password">New Password<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                    required />
                                @error('password')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="password_confirmation">Confirm Password<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" required />
                                @error('password_confirmation')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="status">Merchant Type<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select" name="merchant_type" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="partner" @selected(old('merchant_type', $merchant->merchant_type) == 'partner')>Partner</option>
                                    <option value="member" @selected(old('merchant_type', $merchant->merchant_type) == 'member')>Member</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="status">Status<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select" name="status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status', $merchant->status) == '1')>Active</option>
                                    <option value="0" @selected(old('status', $merchant->status) == '0')>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="prefix">Prefix<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" placeholder="Enter Prefix" class="form-control" name="prefix"
                                    value="{{ old('prefix', $merchant->code->first()->prefix) }}" required />
                            </div>
                            @error('prefix')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="start_code">Start Code<span
                                        class="ms-1 text-red-600">*</span></label>
                                @php
                                    $first = explode('-', $merchant->code->first()->code)[1];
                                    $end = explode('-', $merchant->code->last()->code)[1];
                                @endphp

                                <input type="number" placeholder="Enter Start Code" class="form-control" name="start_code"
                                    value="{{ old('start_code', $first) }}" required />
                            </div>
                            @error('start_code')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="end_code">End Code<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter End Code" class="form-control" name="end_code"
                                    value="{{ old('end_code', $end) }}" required />
                            </div>
                            @error('end_code')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                        </button>
                        <a href="{{ route('admin.merchant.index') }}" class="btn btn-default">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
