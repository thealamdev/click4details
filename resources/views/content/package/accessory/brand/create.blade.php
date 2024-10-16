@extends('layouts.master')
@section('title', 'Create Brand')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0">Create Brand</h4>
            <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
        </div>
    </div>
    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <form action="{{ route('admin.accessory.brand.store') }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span class="ms-1 text-red-600">*</span></label>
                    <input type="text" class="form-control" name="title[en]" value="{{ old('title.en') }}" required />
                    @error('title.en') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                    <input type="text" class="form-control" name="title[bn]" value="{{ old('title.bn') }}" required />
                    @error('title.bn') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label fw-500 mb-1" for="charge">Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
                    @error('charge') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-dark border-0">
                        <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                    </button>
                    <a href="{{ route('admin.accessory.brand.index') }}" class="btn btn-default">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

 