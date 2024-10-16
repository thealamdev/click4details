@extends('layouts.master')
@section('title', 'Create Rental Category')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Rental Category</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.rental.category.store') }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="name">Name<span class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="enter category name" required />
                                @error('name')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="icon">Icon<a href="https://fontawesome.com/search" class="ms-1 text-decoration-none" target="_blank"><span class="text-dark">collect more from</span><strong class="ms-1">Font Awesome</strong></a><span class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="class name of icon" required />
                                @error('icon')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="link">Link<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select" name="link" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($links as $each)
                                        <option value="{{ $each->name }}" @selected(old('link') == $each->name)>{{ $each->call }}</option>
                                    @endforeach
                                </select>
                                @error('link')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="status">Status<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select" name="status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status') == '1')>Active</option>
                                    <option value="0" @selected(old('status') == '0')>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                        </button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
