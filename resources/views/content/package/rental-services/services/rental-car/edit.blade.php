@extends('layouts.master')
@section('title', 'Rental Car Update')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Rental Car Update</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.rental.service.car.update', ['rentCar' => $rentCar?->id]) }}" method="POST" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    @method('put')
                    <input type="hidden" name="image_id" value="{{ $rentCar?->image?->id }}" />
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[en]">Title in English<span class="ms-1 text-red-600">*</span></label>
                                <input type="text" class="form-control" name="title[en]" value="{{ old('title.en', toLocaleString($rentCar->translate, 'en')) }}" required />
                                @error('title.en')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="title[bn]">Title in Bengali</label>
                                <input type="text" class="form-control" name="title[bn]" value="{{ old('title.bn', toLocaleString($rentCar->translate, 'bn')) }}" required />
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
                                    @foreach ($composeMerchant as $each)
                                        <option value="{{ $each->id }}" @selected(old('merchant_id', $rentCar->merchant_id) == $each->id)>
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
                                <label class="form-label fw-500 mb-1" for="brand_id">Brand<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('brand_id') {{ 'is-invalid' }} @enderror" name="brand_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeBrand as $each)
                                        <option value="{{ $each->id }}" @selected(old('brand_id', $rentCar?->brand_id) == $each->id)>
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
                                <label class="form-label fw-500 mb-1" for="carmodel_id">Model<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('carmodel_id') {{ 'is-invalid' }} @enderror" name="carmodel_id" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($composeCarmodel as $each)
                                        <option value="{{ $each->id }}" @selected(old('carmodel_id', $rentCar?->carmodel_id) == $each->id)>
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
                                <label class="form-label fw-500 mb-1" for="ac">AC<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('ac') {{ 'is-invalid' }} @enderror" name="ac" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="AC" @selected(old('ac', $rentCar?->ac) == 'AC')>AC</option>
                                    <option value="Non AC" @selected(old('ac', $rentCar?->ac) == 'Non AC')>Non AC</option>
                                </select>
                                @error('ac')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="vehicle_type">Vehicle Type<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('vehicle_type') {{ 'is-invalid' }} @enderror" name="vehicle_type" required>
                                    <option selected disabled>Please Select...</option>
                                    @foreach ($vehicle_type as $each)
                                        <option value="{{ $each }}" @selected(old('vehicle_type', $rentCar?->vehicle_type) == $each)>{{ $each }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_type')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="vehicle_status">Vehicle Status<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('vehicle_status') {{ 'is-invalid' }} @enderror" name="vehicle_status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="Luxury" @selected(old('vehicle_status', $rentCar?->vehicle_status) == 'Luxury')>Luxury</option>

                                </select>
                                @error('vehicle_status')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="seat">Vehicle Seat<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" class="form-control" value="{{ $rentCar?->seat }}" placeholder="Enter Vehicle Total Seat" name="seat" @error('seat')
                                    {{ 'is-invalid' }}  
                                @enderror required>
                                @error('seat')
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
                                        <option value="{{ $each->id }}" @selected(old('color_id', $rentCar->color_id) == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row p-0 m-0">
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="daily_charge_inside_dhaka">Daily Charge Inside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="daily_charge_inside_dhaka" value="{{ $rentCar?->daily_charge_inside_dhaka }}" placeholder="Daily Charge Inside Dhaka" class="form-control" @error('daily_charge_inside_dhaka') {{ 'is-invalid' }} @enderror">
                                    @error('daily_charge_inside_dhaka')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="daily_max_visit_inside">Daily Visit Limit Inside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="daily_max_visit_inside" value="{{ $rentCar?->daily_max_visit_inside }}" placeholder="Daily Visit Limit Inside Dhaka" class="form-control" @error('daily_max_visit_inside') {{ 'is-invalid' }} @enderror">
                                    @error('daily_max_visit_inside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="extra_charge_perkm_daily_inside">Daily Extra Visit Charge Inside Dhaka(Hourly)<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="extra_charge_perkm_daily_inside" value="{{ $rentCar?->extra_charge_perkm_daily_inside }}" placeholder="Daily Extra Visit Charge Inside Dhaka" class="form-control" @error('extra_charge_perkm_daily_inside') {{ 'is-invalid' }} @enderror">
                                    @error('extra_charge_perkm_daily_inside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row p-0 m-0">
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="daily_charge_outside_dhaka">Daily Charge Outside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="daily_charge_outside_dhaka" value="{{ $rentCar?->daily_charge_outside_dhaka }}" placeholder="Daily charge Outside Dhaka" class="form-control" @error('daily_charge_outside_dhaka') {{ 'is-invalid' }} @enderror">
                                    @error('daily_charge_outside_dhaka')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="daily_max_visit_outside">Daily Visit Limit Outside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="daily_max_visit_outside" value="{{ $rentCar?->daily_max_visit_outside }}" placeholder="Daily Visit Limit Outside Dhaka" class="form-control" @error('daily_max_visit_outside') {{ 'is-invalid' }} @enderror">
                                    @error('daily_max_visit_outside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="extra_charge_perkm_daily_outside">Daily Extra Visit Charge Outside Dhaka(Hourly)<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="extra_charge_perkm_daily_outside" value="{{ $rentCar?->extra_charge_perkm_daily_outside }}" placeholder="Daily Extra Visit Charge Outside Dhaka" class="form-control" @error('extra_charge_perkm_daily_outside') {{ 'is-invalid' }} @enderror">
                                    @error('extra_charge_perkm_daily_outside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row p-0 m-0">
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="monthly_charge_inside_dhaka">Monthly Charge Inside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="monthly_charge_inside_dhaka" value="{{ $rentCar?->monthly_charge_inside_dhaka }}" placeholder="Monthly Charge Inside Dhaka" class="form-control" @error('monthly_charge_inside_dhaka') {{ 'is-invalid' }} @enderror">
                                    @error('monthly_charge_inside_dhaka')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="monthly_max_visit_inside">Monthly Visit Limit Inside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="monthly_max_visit_inside" value="{{ $rentCar?->monthly_max_visit_inside }}" placeholder="Monthly Visit Limit Inside Dhaka" class="form-control" @error('monthly_max_visit_inside') {{ 'is-invalid' }} @enderror">
                                    @error('monthly_max_visit_inside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="monthly_max_visit_charge_dai_inside">Monthly Extra Visit Charge Inside Dhaka(Daily)<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="monthly_max_visit_inside" value="{{ $rentCar?->monthly_max_visit_inside }}" placeholder="Monthly Extra Visit Charge Inside Dhaka" class="form-control" @error('monthly_max_visit_inside') {{ 'is-invalid' }} @enderror">
                                    @error('monthly_max_visit_inside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row p-0 m-0">
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="monthly_charge_outside_dhaka">Monthly Charge Outside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="monthly_charge_outside_dhaka" value="{{ $rentCar?->monthly_charge_outside_dhaka }}" placeholder="Monthly charge Outside Dhaka" class="form-control" @error('monthly_charge_outside_dhaka') {{ 'is-invalid' }} @enderror">
                                    @error('monthly_charge_outside_dhaka')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="monthly_max_visit_outside">Monthly Visit Limit Outside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="monthly_max_visit_outside" value="{{ $rentCar?->monthly_max_visit_outside }}" placeholder="Monthly Visit Limit Outside Dhaka" class="form-control" @error('monthly_max_visit_outside') {{ 'is-invalid' }} @enderror">
                                    @error('monthly_max_visit_outside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="extra_charge_perkm_monthly_outside">Monthly Extra Visit Charge Outside Dhaka<span class="ms-1 text-red-600">*</span></label>
                                    <input type="number" name="extra_charge_perkm_monthly_outside" value="{{ $rentCar?->extra_charge_perkm_monthly_outside }}" placeholder="Monthly Visit Limit Outside Dhaka" class="form-control" @error('extra_charge_perkm_monthly_outside') {{ 'is-invalid' }} @enderror">
                                    @error('extra_charge_perkm_monthly_outside')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="mileages">Mileage<span class="ms-1 text-red-600">*</span></label>
                                <input type="number" value="{{ old('mileages', $rentCar?->mileages) }}" name="mileages" class="form-control @error('mileages') {{ 'is-invalid' }} @enderror" placeholder="Enter mileages">
                                @error('mileages')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-500 mb-1" for="status">Status<span class="ms-1 text-red-600">*</span></label>
                                <select class="form-select" name="status" required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status', $rentCar?->status) == '1')>Active</option>
                                    <option value="0" @selected(old('status', $rentCar?->status) == '0')>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Save
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
            uploadsDragDrop()
        })
    </script>
@endpush
