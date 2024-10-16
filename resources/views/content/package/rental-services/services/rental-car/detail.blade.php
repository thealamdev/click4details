@extends('layouts.master')
@section('title', 'Create Description')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Description</h4>
                <p>Prior to create a new role, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.rental.service.car.description.store', ['rentCar' => $rentCar->id]) }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    <div class="row gx-3">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="description[en]">Description in English<span class="ms-1 text-red-600">*</span></label>
                                <textarea name="description[en]" id="markdown1" class="form-control @error('description.en') {{ 'is-invalid' }} @enderror" rows="2">{{ old('description.en', toLocaleString($rentCar->description, 'en', 'content')) }}</textarea>
                                @error('description.en')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="description[bn]">Description in Bengali<span class="ms-1 text-red-600">*</span></label>
                                <textarea name="description[bn]" id="markdown2" class="form-control @error('description.bn') {{ 'is-invalid' }} @enderror" rows="2">{{ old('description.bn', toLocaleString($rentCar->description, 'bn', 'content')) }}</textarea>
                                @error('description.bn')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Next
                        </button>
                        <a href="{{ route('admin.rental.service.car.index') }}" class="btn btn-default">
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
        $(document).ready(function() {
            mdeMarkdownEditor('markdown1')
            mdeMarkdownEditor('markdown2')
        })
    </script>
@endpush
