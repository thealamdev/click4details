@extends('layouts.master')
@section('title', 'Update Skeleton')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0">Update Skeleton</h4>
            <p>Prior to update resource, make sure asterisk (*) signs are filled</p>
        </div>
    </div>
    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <form action="{{ route('admin.vehicle.skeleton.update', ['skeleton' => $skeleton->id]) }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span class="ms-1 text-red-600">*</span></label>
                    <input type="text" class="form-control" name="title[en]" value="{{ old('title.en', toLocaleString($skeleton->translate)) }}" required />
                    @error('title.en') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                    <input type="text" class="form-control" name="title[bn]" value="{{ old('title.bn', toLocaleString($skeleton->translate, 'bn')) }}" required />
                    @error('title.bn') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-500 mb-1" for="status">Status<span class="ms-1 text-red-600">*</span></label>
                    <select class="form-select" name="status" required>
                        <option selected disabled>Please Select...</option>
                        <option value="1" @selected(old('status', $skeleton->status)=='1' )>Active</option>
                        <option value="0" @selected(old('status', $skeleton->status)=='0' )>Inactive</option>
                    </select>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-dark border-0">
                        <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                    </button>
                    <a href="{{ route('admin.vehicle.skeleton.index') }}" class="btn btn-default">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
