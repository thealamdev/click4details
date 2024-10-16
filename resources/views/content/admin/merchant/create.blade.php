@extends('layouts.master')
@section('title', 'Create Merchant')
@section('content')
    <div class="container">
        <!-- Create Post Form -->
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Merchant</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.merchant.store') }}" method="POST" accept-charset="utf-8" autocomplete="on"
                    class="need-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="name">Name<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required />
                            </div>
                            @error('name')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="email">Email<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required />
                            </div>
                            @error('email')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="mobile">Mobile<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="tel" class="form-control" name="mobile" value="{{ old('mobile') }}"
                                    required />
                            </div>
                            @error('mobile')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="password">New Password<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                    required />
                            </div>

                            @error('password')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="password_confirmation">Confirm Password<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" required />
                            </div>

                            @error('password_confirmation')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="status">Status<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select" name="status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status') == '1')>Active</option>
                                    <option value="0" @selected(old('status') == '0')>Inactive</option>
                                </select>
                            </div>
                            @error('status')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="prefix">Prefix<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" placeholder="Enter Prefix" class="form-control" name="prefix" value="{{ old('prefix') }}"
                                    required />
                            </div>
                            @error('prefix')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="start_code">Start Code<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter Start Code" class="form-control" name="start_code" value="{{ old('start_code') }}"
                                    required />
                            </div>
                            @error('start_code')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="end_code">End Code<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter End Code" class="form-control" name="end_code" value="{{ old('end_code') }}"
                                    required />
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
