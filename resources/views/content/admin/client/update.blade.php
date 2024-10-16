@extends('layouts.master')
@section('title', 'Update Client')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0">Update Client</h4>
            <p>Prior to update resource, make sure asterisk (*) signs are filled</p>
        </div>
    </div>
    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <form action="{{ route('admin.client.update', ['client' => $client->id]) }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                @csrf
                @method('put')
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="name">Name<span class="ms-1 text-red-600">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required />
                            @error('name') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="email">Email<span class="ms-1 text-red-600">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required />
                            @error('email') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="mobile">Mobile<span class="ms-1 text-red-600">*</span></label>
                            <input type="tel" class="form-control" name="mobile" value="{{ old('mobile') }}" required />
                            @error('mobile') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="new_password">New Password<span class="ms-1 text-red-600">*</span></label>
                            <input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}" required />
                            @error('new_password') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="confirm_password">Confirm Password<span class="ms-1 text-red-600">*</span></label>
                            <input type="password" class="form-control" name="confirm_password" value="{{ old('confirm_password') }}" required />
                            @error('confirm_password') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="status">Status<span class="ms-1 text-red-600">*</span></label>
                            <select class="form-select" name="status" required>
                                <option selected disabled>Please Select...</option>
                                <option value="1" @selected(old('status')=='1' )>Active</option>
                                <option value="0" @selected(old('status')=='0' )>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-dark border-0">
                        <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                    </button>
                    <a href="{{ route('admin.client.index') }}" class="btn btn-default">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection