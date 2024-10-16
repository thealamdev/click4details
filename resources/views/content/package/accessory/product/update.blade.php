@extends('layouts.master')
@section('title', 'Update Accessory')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Accessory</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.accessory.product.update',['product' => $accessory->id]) }}" method="POST" accept-charset="utf-8"
                    autocomplete="on" class="need-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="image_id" value="{{ $accessory?->image?->id }}" />
                    <div class="row gx-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="title[en]"
                                    value="{{ old('title.en', toLocaleString($accessory->translate)) }}" required />
                                @error('title.en')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                                <input type="text" class="form-control" name="title[bn]"
                                    value="{{ old('title.bn', toLocaleString($accessory->translate, 'bn')) }}" required />
                                @error('title.bn')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="category_id">Category<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('category_id') {{ 'is-invalid' }} @enderror"
                                    name="category_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeCategory as $each)
                                        @if (in_array($each->title, ['Accessory']))
                                            <option value="{{ $each->id }}" @selected(old('category_id', $accessory->category_id) == $each->id)>
                                                {{ $each->title }}</option>
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
                                <label class="form-label fw-500 mb-1" for="merchant_id">Merchant<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('merchant_id') {{ 'is-invalid' }} @enderror"
                                    name="merchant_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeMerchant as $each)
                                        <option value="{{ $each->id }}" @selected(old('merchant_id', $accessory->merchant_id == $each->id))>
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
                                <label class="form-label fw-500 mb-1" for="land_size">Code<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="text" placeholder="Enter Code"
                                    class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="code"
                                    value="{{ old('code', $accessory->code) }}" />
                                @error('code')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="price">Price<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter Price"
                                    class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="price"
                                    value="{{ old('price', $accessory->price) }}" />
                                @error('price')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="price">Quantity<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="number" placeholder="Enter Quantity"
                                    class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="quantity"
                                    value="{{ old('quantity', $accessory->quantity) }}" />
                                @error('quantity')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="is_approved">Approval<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('is_approved') {{ 'is-invalid' }} @enderror"
                                    name="is_approved" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('is_approved', $accessory->is_approved) == '1')>Approved</option>
                                    <option value="0" @selected(old('is_approved', $accessory->is_approved) == '0')>Pending</option>

                                </select>
                                @error('is_approved')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="image">Cover or Main Image</label>
                                <input type="file" name="image" class="form-control dropify @error('image') {{ 'is-invalid' }} @enderror" data-max-file-size="3M" accept=".png, .jpg, .jpeg" data-allowed-file-extensions="jpg png jpeg" required />
                                @error('image') <div class="invalid-feedback text-red-600">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="publish_at">Published Date<span
                                        class="ms-1 text-red-600">*</span></label>
                                <input type="datetime-local"
                                    class="form-control @error('publish_at') {{ 'is-invalid' }} @enderror"
                                    name="publish_at" value="{{ old('publish_at', $accessory->publish_at) }}" required />
                                @error('publish_at')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="status">Status<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('status') {{ 'is-invalid' }} @enderror" name="status"
                                    required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status', $accessory->status) == '1')>Active</option>
                                    <option value="0" @selected(old('status', $accessory->status) == '0')>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Next
                        </button>
                        <a href="{{ route('admin.accessory.product.index') }}" class="btn btn-default">
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
