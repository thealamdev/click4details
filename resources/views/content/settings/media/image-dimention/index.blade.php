@extends('layouts.master')
@section('title', 'Settings|Image Dimention')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Image Dimention here...</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.setting.media.image-dimentin.updateOrCreate') }}" method="POST"
                    accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 m-auto d-flex justify-content-center align-items-center"
                            style="width: {{ $dimention?->width }}{{ $dimention?->unit }};background:gray;height:{{ $dimention?->height }}{{ $dimention?->unit }};border-radius:10px">
                            <h1 class="text-secondary">{{ $dimention?->width ?? '0' }} * {{ $dimention?->height ?? '0' }}
                            </h1>
                        </div>
                    </div>

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $dimention?->id }}">
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <label for="width">Width <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="width" value="{{ $dimention?->width }}"
                                    placeholder="enter image width dimention..">
                                @error('width')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <label for="height">Height <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="height" value="{{ $dimention?->height }}"
                                    placeholder="enter image height dimention..">
                                @error('height')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <label for="height">Unit <span class="text-danger">*</span></label>
                                <select name="unit" class="form-control">
                                    <option disabled>-Select unit--</option>
                                    <option value="{{ $$dimention?->unit ?? 'px' }}">Px</option>
                                </select>
                                @error('height')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
