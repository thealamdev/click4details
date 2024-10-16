<form action="{{ route('admin.vehicle.product.update', ['product' => $product->id]) }}" method="POST"
    accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="hidden" name="image_id" value="{{ $product?->image?->id }}" />
    <div class="row gx-3">
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span
                        class="ms-1 text-red-600">*</span></label>
                <input type="text" class="form-control" name="title[en]"
                    value="{{ old('title.en', toLocaleString($product->translate)) }}" required />
                @error('title.en')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                <input type="text" class="form-control" name="title[bn]"
                    value="{{ old('title.bn', toLocaleString($product->translate, 'bn')) }}" required />
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
                <label class="form-label fw-500 mb-1" for="merchant_id">Merchant<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select merchant @error('merchant_id') {{ 'is-invalid' }} @enderror"
                    name="merchant_id" required>
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
                <label class="form-label fw-500 mb-1" for="brand_id">Brand<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('brand_id') {{ 'is-invalid' }} @enderror"
                    name="brand_id" required>
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
                <label class="form-label fw-500 mb-1" for="condition_id">Condition<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('condition_id') {{ 'is-invalid' }} @enderror"
                    name="condition_id" required>
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
        <button type="button" class="btn btn-primary d-none" data-toggle="modal"
            data-target="#featureModal">
            Open Modal
        </button>

        <!-- The Modal -->
        <div class="modal fade" id="featureModal" tabindex="-1" role="dialog"
            aria-labelledby="featureModalLabel" aria-hidden="true">
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
                <label class="form-label fw-500 mb-1" for="edition_id">Edition<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select edition @error('edition_id') {{ 'is-invalid' }} @enderror"
                    name="edition_id" required id="editionSelect">
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

        {{-- <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="mileage_id">Mileage<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('mileage_id') {{ 'is-invalid' }} @enderror"
                    name="mileage_id" required>
                    <option selected disabled>Please Select...</option>
                    @foreach ($composeMileage as $each)
                        <option value="{{ $each->id }}" @selected(old('mileage_id', $product->mileage_id) == $each->id)>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
                @error('mileage_id')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="mileages">Mileage<span
                        class="ms-1 text-red-600">*</span></label>
                <input type="number" name="mileages" value="{{ old('mileages', $product->mileages) }}"
                    class="form-control" placeholder="Enter mileages"
                    @error('mileages')
                    {{ 'is-invalid' }}
                @enderror>
                @error('mileages')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>
        {{-- <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="engine_id">Engine<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('engine_id') {{ 'is-invalid' }} @enderror"
                    name="engine_id" required>
                    <option selected disabled>Please Select...</option>
                    @foreach ($composeEngine as $each)
                        <option value="{{ $each->id }}" @selected(old('engine_id', $product->engine_id) == $each->id)>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
                @error('engine_id')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="engines">Engine(cc)<span
                        class="ms-1 text-red-600">*</span></label>
                <input type="number" value="{{ old('engines', $product?->engines) }}"
                    class="form-select @error('engines') {{ 'is-invalid' }} @enderror" name="engines"
                    required>

                @error('engines')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="fuel_id">Fuel<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('fuel_id') {{ 'is-invalid' }} @enderror"
                    name="fuel_id" required>
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
                <label class="form-label fw-500 mb-1" for="skeleton_id">Skeleton or Body<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('skeleton_id') {{ 'is-invalid' }} @enderror"
                    name="skeleton_id" required>
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
                <label class="form-label fw-500 mb-1" for="transmission_id">Transmission<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('transmission_id') {{ 'is-invalid' }} @enderror"
                    name="transmission_id" required>
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


        {{-- new code  --}}
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="carmodel_id">Model<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('carmodel_id') {{ 'is-invalid' }} @enderror"
                    name="carmodel_id" required>
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
                <label class="form-label fw-500 mb-1" for="color_id">Color<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('color_id') {{ 'is-invalid' }} @enderror"
                    name="color_id" required>
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
                <label class="form-label fw-500 mb-1" for="code">Code<span
                        class="ms-1 text-red-600">*</span></label>
                <select name="code" id="coding"
                    class="form-control @error('code') {{ 'is-invalid' }} @enderror">
                    <option selected disabled>-- Select Code --</option>
                    @foreach ($codes as $code)
                        <option @selected(old('code', $product->code) == $code) value="{{ $code }}">
                            {{ $code }}</option>
                    @endforeach
                </select>

                @error('code')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="grade_id">Grade<span
                        class="ms-1 text-red-600"></span></label>
                <select class="form-select @error('grade_id') {{ 'is-invalid' }} @enderror"
                    name="grade_id" required>
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
                <label class="form-label fw-500 mb-1" for="available_id">Available<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('available_id') {{ 'is-invalid' }} @enderror"
                    name="available_id" required>
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
                <label class="form-label fw-500 mb-1" for="registration_id">Registration<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('registration_id') {{ 'is-invalid' }} @enderror"
                    name="registration_id" required>
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
        {{-- prioty --}}
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="prioty">Prioty<span
                        class="ms-1 text-red-600"></span></label>
                <input type="number" placeholder="Enter Prioty"
                    class="form-control @error('prioty') {{ 'is-invalid' }} @enderror" name="prioty"
                    value="{{ old('prioty', $product->prioty) }}" />
                @error('prioty')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="video">Video<span
                        class="ms-1 text-red-600"></span></label>

                <textarea type="text" placeholder="Enter video iframe"
                    class="form-control @error('video') {{ 'is-invalid' }} @enderror" name="video" cols="30"
                    rows="1">{{ old('video', $product->video) }}</textarea>

                @error('video')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="purchase_price">Purchase Price<span
                        class="ms-1 text-red-600"></span></label>
                <input type="number" min="10000"
                    value="{{ old('purchase_price', $product->purchase_price) }}"
                    class="form-control @error('purchase_price') {{ 'is-invalid' }} @enderror"
                    name="purchase_price" value="{{ old('purchase_price') }}" />
                @error('purchase_price')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="price">Asking Price<span
                        class="ms-1 text-red-600">*</span></label>
                <input type="number" min="10000"
                    class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="price"
                    value="{{ old('price', $product->price) }}" required />
                @error('price')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="fixed_price">Fixed Price<span
                        class="ms-1 text-red-600"></span></label>
                <input type="number" min="10000"
                    value="{{ old('fixed_price', $product->fixed_price) }}"
                    class="form-control @error('fixed_price') {{ 'is-invalid' }} @enderror"
                    name="fixed_price" value="{{ old('fixed_price') }}" />
                @error('fixed_price')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="additional_price">Additional Price<span
                        class="ms-1 text-red-600"></span></label>
                <input type="number" min="10000"
                    value="{{ old('additional_price', $product->additional_price) }}"
                    class="form-control @error('additional_price') {{ 'is-invalid' }} @enderror"
                    name="additional_price" value="{{ old('additional_price') }}" />
                @error('additional_price')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="negotiable">Negotiable<span
                        class="ms-1 text-red-600">*</span></label>
                <select name="negotiable"
                    class="form-control @error('negotiable') {{ 'is-invalid' }} @enderror"">
                    <option selected disabled>Please Select...</option>
                    <option value="1" @selected(old('negotiable', $product->negotiable) == '1')>Negotiable</option>
                    <option value="0" @selected(old('negotiable', $product->negotiable) == '0')>Fixed</option>
                </select>

                @error('negotiable')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="image">Cover or Main Image</label>
                <input type="file" name="image"
                    class="form-control dropify @error('image') {{ 'is-invalid' }} @enderror"
                    data-max-file-size="3M" accept=".png, .jpg, .jpeg"
                    data-allowed-file-extensions="jpg png jpeg" required />
                @error('image')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="engine_number">Engine Number<span
                        class="ms-1 text-red-600"></span></label>
                <input type="text" placeholder="Enter Engine Number"
                    class="form-control @error('engine_number') {{ 'is-invalid' }} @enderror"
                    name="engine_number" value="{{ old('engine_number', $product->engine_number) }}" />
                @error('engine_number')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="chassis_number">Chassis Number<span
                        class="ms-1 text-red-600"></span></label>
                <input type="text" placeholder="Enter Chassis Number"
                    class="form-control @error('chassis_number') {{ 'is-invalid' }} @enderror"
                    name="chassis_number"
                    value="{{ old('chassis_number', $product->chassis_number) }}" />
                @error('chassis_number')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="registration">Registration<span
                        class="ms-1 text-red-600"></span></label>
                <select class="form-select @error('registration') {{ 'is-invalid' }} @enderror"
                    name="registration">
                    <option selected disabled>Please Select...</option>
                    <option value="">None</option>
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
                <label class="form-label fw-500 mb-1" for="manufacture">Manufacture<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('manufacture') {{ 'is-invalid' }} @enderror"
                    name="manufacture" required>
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

        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="is_approved">Approval<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('is_approved') {{ 'is-invalid' }} @enderror"
                    name="is_approved" required>
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
                <label class="form-label fw-500 mb-1" for="publish_at">Published Date<span
                        class="ms-1 text-red-600">*</span></label>
                <input type="datetime-local"
                    class="form-control @error('publish_at') {{ 'is-invalid' }} @enderror"
                    name="publish_at" value="{{ old('publish_at', $product->publish_at) }}" required />
                @error('publish_at')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="is_feat">Featured<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('is_feat') {{ 'is-invalid' }} @enderror"
                    name="is_feat" required>
                    <option selected disabled>Please Select...</option>
                    <option value="1" @selected(old('is_feat', $product->is_feat) == '1')>Yes</option>
                    <option value="0" @selected(old('is_feat', $product->is_feat) == '0')>No</option>
                </select>
                @error('is_feat')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="status">Status<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('status') {{ 'is-invalid' }} @enderror"
                    name="status" required>
                    <option selected disabled>Please Select...</option>
                    <option value="1" @selected(old('status', $product->status) == '1')>Active</option>
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
        <a href="{{ route('admin.vehicle.product.index') }}" class="btn btn-default">
            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
</form>