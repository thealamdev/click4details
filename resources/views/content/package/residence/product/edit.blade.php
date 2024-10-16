@extends('layouts.master')
@section('title', 'Create Residence')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Residence</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.residence.product.update', ['residence' => $residence->id]) }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" placeholder="short title in english" name="title[en]" value="{{ old('title.en', toLocaleString($residence->translate, 'en')) }}" required />
                                @error('title.en')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                                <input type="text" class="form-control" placeholder="short title in bangla" name="title[bn]" value="{{ old('title.bn', toLocaleString($residence->translate, 'bn')) }}" required />
                                @error('title.bn')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="merchant_id">Merchant<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select merchant @error('merchant_id') {{ 'is-invalid' }} @enderror" name="merchant_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($merchants as $each)
                                        <option value="{{ $each->id }}" @selected(old('merchant_id', $residence->merchant_id) == $each->id)>
                                            {{ sprintf('%s (%s)', $each->name, $each->email) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('merchant_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="unit_price">Price Unit & Price</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <select name="unit_price">
                                        <option value="Unit Price" @selected(old('unit_price', $residence?->unit_price) == 'Unit Price')>Unit Price</option>
                                        <option value="Full Price" @selected(old('unit_price', $residence?->unit_price) == 'Full Price')>Full Price</option>
                                    </select>
                                    @error('unit_price')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="number" placeholder="enter price" value="{{ old('price', $residence?->price) }}" name="price" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="negotiable">Negotiable</label>
                            <select name="negotiable" class="form-control">
                                <option value="yes" @selected(old('negotiable', $residence?->negotiable) == 'yes')>Negotiable</option>
                                <option value="no" @selected(old('negotiable', $residence?->negotiable) == 'no')>Fixed</option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="address">Address</label>
                            <input type="text" name="address" value="{{ old('address', $residence?->address) }}" class="form-control" placeholder="enter address">
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="image">Cover or Main Image</label>
                                <input type="file" name="image" class="form-control dropify @error('image') {{ 'is-invalid' }} @enderror" data-max-file-size="3M" accept=".png, .jpg, .jpeg" data-allowed-file-extensions="jpg png jpeg" required />
                                @error('image')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="image_id" value="{{ $residence?->image?->id }}" />
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="bedrooms">Bedrooms</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms', $residence?->bedrooms) }}" class="form-control" placeholder="enter bedrooms">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="bathrooms">Bathrooms</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms', $residence?->bathrooms) }}" class="form-control" placeholder="enter bathrooms">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="size">Size(sqrtft)</label>
                            <input type="number" name="size" value="{{ old('size', $residence?->size) }}" class="form-control" placeholder="enter size">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="facing">Facing</label>
                            <input type="text" name="facing" value="{{ old('facing', $residence?->facing) }}" class="form-control" placeholder="enter facing">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="completion_status_id">Completion Status</label>
                            <select name="completion_status_id" class="form-control">
                                <option selected disabled>--Select Option--</option>
                                @foreach ($completion_status as $each)
                                    <option value="{{ $each->id }}" @selected(old('completion_status_id', $residence?->completion_status_id) == $each?->id)>{{ toLocaleString($each?->translate, 'en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="furnished_status_id">Furnished Status</label>
                            <select name="furnished_status_id" class="form-control">
                                <option selected disabled>--Select Option--</option>
                                @foreach ($furnished_status as $each)
                                    <option value="{{ $each->id }}" @selected(old('furnished_status_id', $residence?->furnished_status_id) == $each?->id)>{{ toLocaleString($each?->translate, 'en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="apartment_complex_id">Apartment Complex</label>
                            <select name="apartment_complex_id" class="form-control">
                                <option selected disabled>--Select Option--</option>
                                @foreach ($apartment_complex as $each)
                                    <option value="{{ $each->id }}" @selected(old('apartment_complex_id', $residence?->apartment_complex_id) == $each?->id)>{{ toLocaleString($each?->translate, 'en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="land_share_apartments">Land Share Apartment</label>
                            <select name="land_share_apartments" class="form-control">
                                <option value="yes" @selected(old('land_share_apartments', $residence?->land_share_apartments) == 'yes')>Yes</option>
                                <option value="no" @selected(old('land_share_apartments', $residence?->land_share_apartments) == 'no')>No</option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="status">Contact Number<span class="ms-1 text-red-600">*</span></label>
                            <input type="number" name="mobile" value="{{ old('mobile', $residence?->mobile) }}" class="form-control" placeholder="enter mobile number">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-500 mb-1" for="status">Status<span class="ms-1 text-red-600">*</span></label>
                            <select class="form-select" name="status" required>
                                <option selected disabled>Please Select...</option>
                                <option value="1" @selected(old('status', $residence?->status) == '1')>Active</option>
                                <option value="0" @selected(old('status', $residence?->status) == '0')>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                        </button>
                        <a href="{{ route('admin.residence.product.index') }}" class="btn btn-default">
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
            uploadsDragDrop()
        })
    </script>
@endpush
