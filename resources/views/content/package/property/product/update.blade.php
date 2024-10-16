@extends('layouts.master')
@section('title', 'Update Land')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Land</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.property.product.update', ['product' => $product->id]) }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="image_id" value="{{ $product?->image?->id }}" />
                    <div class="row gx-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="title[en]" value="{{ old('title.en', toLocaleString($product->translate)) }}" required />
                                @error('title.en')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                                <input type="text" class="form-control" name="title[bn]" value="{{ old('title.bn', toLocaleString($product->translate, 'bn')) }}" required />
                                @error('title.bn')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="category_id">Category<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('category_id') {{ 'is-invalid' }} @enderror" name="category_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeCategory as $each)
                                        @if (in_array($each->title, ['Land', 'Vehicle']))
                                            <option value="{{ $each->id }}" @selected(old('category_id', $product->category_id) == $each->id)>{{ $each->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="merchant_id">Merchant<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('merchant_id') {{ 'is-invalid' }} @enderror" name="merchant_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeMerchant as $each)
                                        <option value="{{ $each->id }}" @selected(old('merchant_id', $product->merchant_id) == $each->id)>
                                            {{ sprintf('%s (%s)', $each->name, $each->email) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('merchant_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="type_id">Land Type<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('type_id') {{ 'is-invalid' }} @enderror" name="type_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeLandType as $each)
                                        <option value="{{ $each->id }}" @selected(old('type_id', $product->type_id) == $each->id)>{{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="land_size">Land Size<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter Land size" class="form-control @error('land_size') {{ 'is-invalid' }} @enderror" name="land_size" value="{{ old('land_size', $product->land_size) }}" />
                                @error('land_size')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="sizeunit_id">Land Size Unit<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('sizeunit_id') {{ 'is-invalid' }} @enderror" name="sizeunit_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeSizeUnit as $each)
                                        <option value="{{ $each->id }}" @selected(old('sizeunit_id', $product->sizeunit_id) == $each->id)>{{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('sizeunit_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="price">Price<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter Price" class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="price" value="{{ old('price', $product->price) }}" />
                                @error('price')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="priceunit_id">Price Unit<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('priceunit_id') {{ 'is-invalid' }} @enderror" name="priceunit_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composePriceUnit as $each)
                                        <option value="{{ $each->id }}" @selected(old('priceunit_id', $product->priceunit_id) == $each->id)>{{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('priceunit_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="negotiable">Negotiable<span class="ms-1 text-green-600">(Optional)</span></label>
                                <select class="form-select @error('negotiable') {{ 'is-invalid' }} @enderror" name="negotiable" required>
                                    <option selected disabled>Please Select...</option>
                                    <option>None</option>
                                    <option value="1" @selected(old('status') == '1')>Yes</option>
                                    <option value="0" @selected(old('status') == '0')>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="mobile" title="contact number for, that we can contact with you." class="form-label fw-500 mb-1">Contact Number <span class="ms-1 text-danger">*</span></label>
                                <input type="number" name="mobile" value="{{ old('mobile', $product?->mobile) }}" placeholder="enter contact number" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="code">Code<span class="ms-1 text-red-600">*</span></label>
                                <input type="text" placeholder="Enter Code" class="form-control @error('code') {{ 'is-invalid' }} @enderror" name="code" value="{{ old('code', $product->code) }}" />
                                @error('code')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="image">Cover or Main Image</label>
                                <input type="file" name="image" class="form-control dropify @error('image') {{ 'is-invalid' }} @enderror" data-max-file-size="3M" accept=".png, .jpg, .jpeg" data-allowed-file-extensions="jpg png jpeg" required />
                                @error('image')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="is_approved">Approval<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('is_approved') {{ 'is-invalid' }} @enderror" name="is_approved" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('is_approved', $product->is_approved) == '1')>Approved</option>
                                    <option value="0" @selected(old('is_approved', $product->is_approved) == '0')>pending</option>
                                </select>
                                @error('is_approved')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="publish_at">Published Date<span class="ms-1 text-red-600">*</span></label>
                                <input type="datetime-local" class="form-control @error('publish_at') {{ 'is-invalid' }} @enderror" name="publish_at" value="{{ old('publish_at', $product->publish_at) }}" required />
                                @error('publish_at')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="status">Status<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('status') {{ 'is-invalid' }} @enderror" name="status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status', $product->status) == '1')>Active</option>
                                    <option value="0" @selected(old('status', $product->status) == '0')>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="address">Address<span class="ms-1 text-green-600">(Optional)</span></label>
                                <textarea name="address" class="form-control" cols="30" rows="1">{!! $product->address !!}</textarea>
                                @error('address')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Next
                        </button>
                        <a href="{{ route('admin.property.product.index') }}" class="btn btn-default">
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
