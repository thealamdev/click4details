@extends('layouts.master')
@section('title', 'Update Vehicle')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Vehicle(Merchant)</h4>
                <p>Prior to update resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('merchant.vehicle.product.update', ['product' => $product->id]) }}" method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate enctype="multipart/form-data">
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
                                        @if (in_array($each->title, ['Car', 'Vehicle']))
                                            <option value="{{ $each->id }}" @selected(old('category_id', $product->category_id) == $each->id)>
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
                                <label class="form-label fw-500 mb-1" for="merchant_id">Merchant<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('merchant_id') {{ 'is-invalid' }} @enderror" name="merchant_id" required>
                                    <option selected value="{{ auth()->user('merchant')->id }}">
                                        {{ sprintf('%s (%s)', auth()->user('merchant')->name, auth()->user('merchant')->email) }}
                                    </option>
                                </select>
                                @error('merchant_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="brand_id">Brand<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('brand_id') {{ 'is-invalid' }} @enderror" name="brand_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeBrand as $each)
                                        <option value="{{ $each->id }}" @selected(old('brand_id', $product->brand_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="condition_id">Condition<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('condition_id') {{ 'is-invalid' }} @enderror" name="condition_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeCondition as $each)
                                        <option value="{{ $each->id }}" @selected(old('condition_id', $product->condition_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('condition_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Button to trigger the modal -->
                        <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#featureModal">
                            Open Modal
                        </button>

                        <!-- The Modal -->
                        <div class="modal fade" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="featureModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="featureModalLabel">Feature Details</h5>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="select-all">
                                            <input type="checkbox">
                                            <label for="checkbox">Select All</label>
                                        </div>

                                        <div class="feature_main d-flex flex-wrap">

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Select for triggering the modal -->
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="edition_id">Edition<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select edition @error('edition_id') {{ 'is-invalid' }} @enderror" name="edition_id" required id="editionSelect">
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeEdition as $each)
                                        <option value="{{ $each->id }}" @selected(old('edition_id', $product->edition_id) == $each->id)>
                                            {{ $each->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('edition_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="engines">Engine<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" class="form-control" name="engines" value="{{ old('engines', $product?->engines) }}" placeholder="enter engine power..">

                                @error('engines')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="mileages">Mileages<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" class="form-control" name="mileages" value="{{ old('mileages', $product?->mileages) }}" placeholder="enter mileages..">

                                @error('mileages')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="fuel_id">Fuel<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('fuel_id') {{ 'is-invalid' }} @enderror" name="fuel_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeFuel as $each)
                                        <option value="{{ $each->id }}" @selected(old('fuel_id', $product->fuel_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('fuel_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="skeleton_id">Skeleton or Body<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('skeleton_id') {{ 'is-invalid' }} @enderror" name="skeleton_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeSkeleton as $each)
                                        <option value="{{ $each->id }}" @selected(old('skeleton_id', $product->skeleton_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('skeleton_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="transmission_id">Transmission<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('transmission_id') {{ 'is-invalid' }} @enderror" name="transmission_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeTransmission as $each)
                                        <option value="{{ $each->id }}" @selected(old('transmission_id', $product->transmission_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('transmission_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="carmodel_id">Model<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('carmodel_id') {{ 'is-invalid' }} @enderror" name="carmodel_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeCarmodel as $each)
                                        <option value="{{ $each->id }}" @selected(old('carmodel_id', $product->carmodel_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('carmodel_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="color_id">Color<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('color_id') {{ 'is-invalid' }} @enderror" name="color_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeColor as $each)
                                        <option value="{{ $each->id }}" @selected(old('color_id', $product->color_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="code">Code<span class="ms-1 text-red-600">*</span></label>
                                <select name="code" id="code" class="form-control">
                                    <option selected disabled>-- Select Code --</option>
                                    @foreach ($codes as $code)
                                        <option value="{{ $code }}" @selected(old('grade_id', $product->code) == $code)>
                                            {{ $code }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('code')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="grade_id">Grade<span class="ms-1 text-red-600"></span></label>
                                <select class="form-select @error('grade_id') {{ 'is-invalid' }} @enderror" name="grade_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeGrade as $each)
                                        <option value="{{ $each->id }}" @selected(old('grade_id', $product->grade_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- updated code  --}}

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="available_id">Available<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('available_id') {{ 'is-invalid' }} @enderror" name="available_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeAvailable as $each)
                                        <option value="{{ $each->id }}" @selected(old('available_id', $product->available_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('available_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- registration --}}
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="registration_id">Registration<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('registration_id') {{ 'is-invalid' }} @enderror" name="registration_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeRegistration as $each)
                                        <option value="{{ $each->id }}" @selected(old('registration_id', $product->registration_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('registration_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="video">Video<span class="ms-1 text-red-600"></span></label>

                                <textarea type="text" placeholder="Enter video iframe" class="form-control @error('video') {{ 'is-invalid' }} @enderror" name="video" cols="30" rows="1">{{ old('video', $product->video) }}</textarea>

                                @error('video')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="purchase_price">Purchase Price<span class="ms-1 text-red-600"></span></label>
                                <input type="number" min="10000" placeholder="enter purchase price" class="form-control @error('purchase_price') {{ 'is-invalid' }} @enderror" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" />
                                @error('purchase_price')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="fixed_price">Fixed Price<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" min="10000" placeholder="enter fixed price" class="form-control @error('fixed_price') {{ 'is-invalid' }} @enderror" name="fixed_price" value="{{ old('fixed_price', $product->fixed_price) }}" />
                                @error('fixed_price')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="price">Asking Price<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" min="10000" class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="price" value="{{ old('price', $product->price) }}" required />
                                @error('price')
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
                                <label class="form-label fw-500 mb-1" for="engine_number">Engine Number<span class="ms-1 text-red-600"></span></label>
                                <input type="text" placeholder="Enter Engine Number" class="form-control @error('engine_number') {{ 'is-invalid' }} @enderror" name="engine_number" value="{{ old('engine_number', $product->engine_number) }}" />
                                @error('engine_number')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="chassis_number">Chassis Number<span class="ms-1 text-red-600"></span></label>
                                <input type="text" placeholder="Enter Chassis Number" class="form-control @error('chassis_number') {{ 'is-invalid' }} @enderror" name="chassis_number" value="{{ old('chassis_number', $product->chassis_number) }}" />
                                @error('chassis_number')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="registration">Registration<span class="ms-1 text-red-600"></span></label>
                                <select class="form-select @error('registration') {{ 'is-invalid' }} @enderror" name="registration">
                                    <option selected disabled>Please Select...</option>
                                    <option>None</option>
                                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                                        <option value="{{ $i }}" @selected(old('registration', $product->registration) == $i)>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('registration')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="manufacture">Manufacture<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('manufacture') {{ 'is-invalid' }} @enderror" name="manufacture" required>
                                    <option selected disabled>Please Select...</option>
                                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                                        <option value="{{ $i }}" @selected(old('manufacture', $product->manufacture) == $i)>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('manufacture')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-none">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="is_approved">Approval<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('is_approved') {{ 'is-invalid' }} @enderror" name="is_approved" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" selected @selected(old('is_approved', $product->is_approved) == '1')>Approved</option>
                                    <option value="0" @selected(old('is_approved', $product->is_approved) == '0')>pending</option>
                                </select>
                                @error('is_approved')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 d-none">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="publish_at">Published Date<span class="ms-1 text-red-600">*</span></label>
                                @php
                                    $currentDate = date('Y-m-d\TH:i', strtotime(now()));
                                @endphp
                                <input type="datetime-local" class="form-control @error('publish_at') {{ 'is-invalid' }} @enderror" name="publish_at" value="{{ old('publish_at', $currentDate) }}" required />
                                @error('publish_at')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 d-none">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="is_feat">Featured<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('is_feat') {{ 'is-invalid' }} @enderror" name="is_feat" required>
                                    <option selected disabled>Please Select...</option>
                                    <option selected value="1" @selected(old('is_feat', $product->is_feat) == '1')>Yes</option>
                                    <option value="0" @selected(old('is_feat', $product->is_feat) == '0')>No</option>
                                </select>
                                @error('is_feat')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="status">Approve<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('status') {{ 'is-invalid' }} @enderror" name="status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" selected @selected(old('status', $product->status) == '1')>Active</option>
                                    <option value="0" @selected(old('status', $product->status) == '0')>Inactive</option>
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
                        <a href="{{ route('merchant.vehicle.product.index') }}" class="btn btn-default">
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

    <script>
        $(document).ready(function() {
            $('.edition').on('change', function() {
                var edition_id = $('.edition').val();
                var product_id = "{{ $product->id }}";
                var url = '{{ route('merchant.vehicle.product.edit', ['product' => ':product_id']) }}';
                url = url.replace(':product_id', product_id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    data: {
                        edition_id: edition_id,
                        product_id: product_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var featureMainDiv = $('.feature_main');
                        var select_all = $('.select-all input');
                        featureMainDiv.empty();

                        var uniqueFeatures = [];

                        var selectAllCheckbox = $('<input>').attr({
                            type: 'checkbox',
                            id: 'select-all-checkbox'
                        });

                        select_all.on('change', function() {
                            var isChecked = $(this).prop('checked');
                            featureMainDiv.find('input[type="checkbox"]').prop(
                                'checked', isChecked);
                        });

                        response.features.detail_feature.forEach(function(detailFeature) {
                            var featureTitle = detailFeature.feature.title;
                            var featureId = detailFeature.feature.id;

                            if (!uniqueFeatures.includes(featureTitle)) {
                                var featureItemDiv = $('<div>').addClass('col-lg-3');
                                var featureTitleElement = $('<h5>').addClass(
                                    'featureTitle mt-3').text(featureTitle);

                                featureItemDiv.append(featureTitleElement);
                                uniqueFeatures.push(featureTitle);

                                response.features.detail_feature.forEach(function(df) {
                                    if (df.feature.title === featureTitle) {
                                        var checkbox = $('<input>').attr({
                                            type: 'checkbox',
                                            value: df.detail.id,
                                            name: 'detail_id[' +
                                                featureId + '][]'
                                        });

                                        response.active_details.forEach(
                                            detail => {
                                                if (df.detail.id == detail
                                                    .detail_id) {
                                                    checkbox.attr('checked',
                                                        'checked');
                                                }
                                            });

                                        var detailTitle = $('<span>').text(df
                                            .detail.title);
                                        var br = $('<br>');
                                        var space = $('<span>').css(
                                            'margin-right', '10px');

                                        featureItemDiv.append(checkbox, space,
                                            detailTitle, br);
                                    }
                                });

                                featureMainDiv.append(featureItemDiv);
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $('#editionSelect').on('change', function() {
            var edition_id = $(this).val();
            var product_id = "{{ $product->id }}";
            var url = '{{ route('merchant.vehicle.product.edit', ['product' => ':product_id']) }}';
            url = url.replace(':product_id', product_id);

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                data: {
                    edition_id: edition_id,
                    product_id: product_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    var featuresDetail = response.features.detail_feature;
                    var featureMainDiv = $('#featureModal').find('.feature_main');
                    featureMainDiv.empty();

                    $('#featureModal').modal('show');
                }
            });
        });
    </script>
@endpush
