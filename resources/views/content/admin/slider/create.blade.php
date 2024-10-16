@extends('layouts.master')
@section('title', 'Create Slider')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0">Create Slider</h4>
            <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
        </div>
    </div>
    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <form action="{{ route('admin.slider.store') }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span class="ms-1 text-red-600">*</span></label>
                            <input type="text" class="form-control" name="title[en]" value="{{ old('title.en') }}" required />
                            @error('title.en') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                            <input type="text" class="form-control" name="title[bn]" value="{{ old('title.bn') }}" required />
                            @error('title.bn') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="image">Cover Logo</label>
                            <input type="file" name="image" class="dropify" data-max-file-size="1M" accept=".png, .jpg, .jpeg" data-allowed-file-extensions="jpg png" />
                            @error('image') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="price">Price</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}" required />
                            @error('price') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="model">Model or Year</label>
                            <input type="text" class="form-control" name="model" value="{{ old('model') }}" required />
                            @error('model') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-500 mb-1" for="link">Link</label>
                            <input type="text" class="form-control" name="link" value="{{ old('link') }}" required />
                            @error('link') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
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
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-default">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    // @todo: document event handler
    $(document).ready(function() {
        uploadsDragDrop()
    })
</script>
@endpush