@extends('layouts.master')
@section('title', 'Create Package')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create {{ toLocaleString($edition->translate) }} Package</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.vehicle.package.store') }}" method="POST" accept-charset="utf-8"
                    autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    <input type="hidden" name="edition_id" value="{{ $edition->id }}">


                    <div class="form-group mb-3">
                        <label class="form-label fw-500 mb-1" for="status">Status<span
                                class="ms-1 text-red-600">*</span></label>
                        <select class="form-select" name="status" required>
                            <option disabled>Please Select...</option>
                            <option selected value="1" @selected(old('status') == '1')>Active</option>
                            <option value="0" @selected(old('status') == '0')>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <div class="row">
                            @foreach ($featurs as $feature)
                                <div class="col-lg-3">

                                    <label class="h4 mb-3"
                                        for="feature_id_{{ $feature->id }}">{{ $feature->title }}</label>
                                    <br>
                                    @foreach ($feature->detail as $detail)
                                        <input type="checkbox" value="{{ $detail->id }}" @foreach ($active_details as $active)
                                            @if($detail->id == $active->detail_id)
                                            {{'checked'}}
                                            @endif
                                        @endforeach
                                            name="detail_id[{{ $feature->id }}][]">
                                        <label class="pb-2" for="detail_id_{{ $detail->id }}">{{ $detail->title }}</label> <br>
                                    @endforeach
                                    <br>
                                    <br>

                                </div>
                            @endforeach
                        </div>

                    </div>


                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                        </button>
                        <a href="{{ route('admin.vehicle.edition.index') }}" class="btn btn-default">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
