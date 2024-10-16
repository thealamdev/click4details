@extends('layouts.master')
@section('title', 'Update Recuirement')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Update Customer Recuirement</h4>
                <p>Prior to create resource, make sure asterisk () signs are filled</p>
            </div>

            <div>
                <h4 class="mb-0">
                    <a href="{{ route('admin.vehicle.requirement.index') }}" class="btn btn-success">All
                        Requirement</a>
                </h4>

            </div>
        </div>

        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.vehicle.requirement.update', ['requirement' => $customer?->id]) }}"
                    method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    @method('put')
                    <h4>Client Details-->Basic Info</h4>
                    <input type="hidden" name="user_id" value="{{ auth()->user()?->id }}">
                    <div class="row gx-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="name">Client Name<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="text" class="form-control formInput" placeholder="Enter Client Name"
                                    value="{{ old('name', $customer?->name) }}" name="name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="mobile">Client Mobile<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput" placeholder="Enter Client Mobile"
                                    value="{{ old('name', $customer?->mobile) }}" name="mobile"
                                    value="{{ old('mobile') }}" />
                                @error('mobile')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="email">Client Email<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="email" class="form-control formInput" placeholder="Enter Client Email"
                                    value="{{ old('name', $customer?->email) }}" name="email"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>Vehicle Info</h4>
                    <div class="row gx-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="brand">Brand<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select formInput brands @error('brand') {{ 'is-invalid' }} @enderror"
                                    name="brand[]" multiple="multiple">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeBrand as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->brandCustomer->pluck('brand')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="skeleton">Skeleton or Body<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select red-border formInput skeleton @error('skeleton') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="skeleton[]" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeSkeleton as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->customerSkeleton->pluck('skeleton')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('skeleton')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="model">Model<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select
                                    class="form-select red-border formInput model @error('model') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="model[]" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeCarmodel as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->carmodelCustomer->pluck('model')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('model')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="transmission">Transmission<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select formInput transmission @error('transmission') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="transmission[]" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeTransmission as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->customerTransmission->pluck('transmission')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('transmission')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="manufacture">Manufacture(Model Year)<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select manufacture formInput @error('manufacture') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="manufacture[]">
                                    <option disabled>Please Select...</option>
                                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                                        <option value="{{ $i }}"
                                            {{ in_array($i, $customer->customerManufacture->pluck('manufacture')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('manufacture')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="available">Available<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select available formInput @error('available') {{ 'is-invalid' }} @enderror"
                                    name="available[]" required multiple="multiple">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeAvailable as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->availableCustomer->pluck('available')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('available')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="edition">Edition<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select red-border formInput edition @error('edition') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="edition[]" id="editionSelect">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeEdition as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->customerEdition->pluck('edition')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('edition')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="engine_start">Engine Capacity Start<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" placeholder="Enter Engine range from" name="engine_start"
                                    value="{{ old('engine_start', implode('[', $customer?->customerEngine->pluck('engine_start')->toArray())) }}"
                                    class="form-control formInput @error('engine_start') {{ 'is-invalid' }} @enderror">

                                @error('engine_start')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="fuel">Fuel<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select red-border formInput fuel @error('fuel') {{ 'is-invalid' }} @enderror"
                                    name="fuel[]" multiple="multiple" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeFuel as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->customerFuel->pluck('fuel')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('fuel')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="engine_end">Engine Capacity End<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" placeholder="Enter Engine range to" name="engine_end"
                                    value="{{ old('engine_end', implode('[', $customer?->customerEngine->pluck('engine_end')->toArray())) }}"
                                    class="form-control formInput @error('engine_end') {{ 'is-invalid' }} @enderror">

                                @error('engine_end')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="condition">Condition<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select red-border formInput condition @error('condition') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="condition[]">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeCondition as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->conditionCustomer->pluck('condition')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('condition')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6"></div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="registration">Registration<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select registration formInput @error('registration') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="registration[]">
                                    <option disabled>Please Select...</option>
                                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                                        <option value="{{ $i }}"
                                            {{ in_array($i, $customer->customerRegistration->pluck('registration')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('registration')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6"></div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="color">Color<span
                                        class="ms-1 text-red-600"></span></label>
                                <select class="form-select formInput color @error('color') {{ 'is-invalid' }} @enderror"
                                    name="color[]" multiple="multiple" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeColor as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->colorCustomer->pluck('color')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-5 pr-0">
                                    <label class="form-label fw-500 mb-1" for="mileage_start">Mileage Start<span
                                            class="ms-1 text-red-600"></span></label>
                                    <input type="number" placeholder="Enter Mileage" name="mileage_start"
                                        value="{{ old('mileage_start', implode('[', $customer?->customerMileage->pluck('mileage_start')->toArray())) }}"
                                        class="form-control formInput border border-danger @error('mileage_start') {{ 'is-invalid' }} @enderror">

                                    @error('mileage_start')
                                        <div class=" text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-2 mt-4 d-flex justify-content-center align-items-center p-0">
                                    <span><i class="fa-solid fa-rotate fs-5"></i></span>
                                </div>
                                <div class="col-lg-5 pl-0">
                                    <label class="form-label fw-500 mb-1" for="mileage_end">Mileage End<span
                                            class="ms-1 text-red-600"></span></label>
                                    <input type="number" placeholder="Enter Mileage" name="mileage_end"
                                        value="{{ old('mileage_end', implode('[', $customer?->customerMileage->pluck('mileage_end')->toArray())) }}"
                                        class="form-control formInput border border-danger @error('mileage_end') {{ 'is-invalid' }} @enderror">

                                    @error('mileage_end')
                                        <div class=" text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="feature">Feature<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select feature formInput @error('feature') {{ 'is-invalid' }} @enderror"
                                    name="feature[]" required multiple="multiple">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeFeature as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->customerFeature->pluck('feature')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="grade">Grade<span
                                        class="ms-1 text-red-600"></span></label>
                                <select class="form-select formInput grade @error('grade') {{ 'is-invalid' }} @enderror"
                                    name="grade[]" multiple="multiple" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeGrade as $each)
                                        <option value="{{ $each->title }}"
                                            {{ in_array($each?->title, $customer->customerGrade->pluck('grade')->toArray()) == true ? 'selected' : '' }}>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('grade')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>Client Details-->Budget Info</h4>

                    <div class="row gx-3">

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-5 pr-0">
                                    <select name="budget_from" class="form-control border border-danger formInput">
                                        <option selected disabled>--budget from--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option @selected(old('budget_from', $customer?->budget_from == $i))>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-lg-2 d-flex justify-content-center align-items-center p-0">
                                    <span><i class="fa-solid fa-rotate fs-5"></i></span>
                                </div>

                                <div class="col-lg-5 pl-0">
                                    <select name="budget_to" class="form-control border border-danger formInput">
                                        <option selected disabled>--budget to--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option @selected(old('budget_to', $customer?->budget_to == $i))>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-5 pr-0">
                                    <select name="ready_budget_from" class="form-control border border-danger formInput">
                                        <option selected disabled>--Ready budget from--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option @selected(old('ready_budget_from', $customer?->ready_budget_from == $i))>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-lg-2 d-flex justify-content-center align-items-center p-0">
                                    <span><i class="fa-solid fa-rotate fs-5"></i></span>
                                </div>

                                <div class="col-lg-5 pl-0">
                                    <select name="ready_budget_to" class="form-control border border-danger formInput">
                                        <option selected disabled>--Ready budget to--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option @selected(old('ready_budget_to', $customer?->ready_budget_to == $i))>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <h4>Client Details --> Loan Info</h4>
                    <div class="row gx-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="loan">Interested for Loan<span
                                        class="ms-1 text-red-600"></span></label>
                                <select name="loan" class="form-control formInput" value="{{ old('loan') }}"
                                    required>
                                    <option disabled selected>--select option--</option>
                                    <option value="yes" @selected(old('loan', $customer?->loan) == 'yes')>Yes</option>
                                    <option value="no" @selected(old('loan', $customer?->loan) == 'no')>No</option>
                                </select>

                                @error('loan')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="bank_loan">Bank Loan Amount<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput"
                                    placeholder="Enter client bank loan amount" name="bank_loan"
                                    value="{{ old('bank_loan', $customer?->bank_loan) }}" required />
                                @error('bank_loan')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="self_pay">Self Pay Amount<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput"
                                    placeholder="Enter client Self Pay Amount" name="self_pay"
                                    value="{{ old('self_pay', $customer?->self_pay) }}" required />
                                @error('self_pay')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="income">Client Income<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput" placeholder="Enter client income"
                                    name="income" value="{{ old('income', $customer?->income) }}" required />
                                @error('income')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="company_transaction">Client Company
                                    Transaction<span class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput"
                                    placeholder="Enter client company transaction" name="company_transaction"
                                    value="{{ old('company_transaction', $customer?->company_transaction) }}" required />
                                @error('company_transaction')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4>Client Details--> Performance info</h4>
                    <div class="row gx-3">

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="level">Client Level<span
                                        class="ms-1 text-red-600"></span>
                                </label>

                                <select name="level" class="form-control formInput" value="{{ old('level') }}"
                                    required>
                                    <option disabled selected>--select option--</option>
                                    <option value="vvip" @selected(old('level', $customer?->level) == 'vvip')>VVIP</option>
                                    <option value="vip" @selected(old('level', $customer?->level) == 'vip')>VIP</option>
                                    <option value="high" @selected(old('level', $customer?->level) == 'high')>High</option>
                                    <option value="low" @selected(old('level', $customer?->level) == 'low')>Low</option>
                                    <option value="medium" @selected(old('level', $customer?->level) == 'medium')>Medium</option>
                                    <option value="not_knowns" @selected(old('level', $customer?->level) == 'not_knowns')>Not Known</option>
                                </select>
                                @error('level')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="serious">Client Seriousness(%)<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput border border-danger"
                                    placeholder="Enter client seriousness" name="serious"
                                    value="{{ old('serious', $customer?->serious) }}" />
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="profession">Client Profession<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="text" class="form-control formInput"
                                    placeholder="Enter client profession" name="profession"
                                    value="{{ old('profession', $customer?->profession) }}" required />
                                @error('profession')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="frequency">Car Change Frequency<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput" placeholder="Enter client frequency"
                                    name="frequency" value="{{ old('frequency', $customer?->frequency) }}" required />
                                @error('frequency')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="purchase_date">Client Last Purchase Date<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="date" class="form-control formInput border border-danger"
                                    placeholder="Enter client last purchase date" name="purchase_date"
                                    value="{{ old('purchase_date', $customer?->purchase_date) }}" required />
                                @error('purchase_date')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="location">Client Location<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="text" class="form-control formInput" placeholder="Enter client location"
                                    name="location" value="{{ old('location', $customer?->location) }}" required />
                                @error('location')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="instraction">Client Instraction<span
                                        class="ms-1 text-red-600"></span>
                                </label>
                                <textarea class="form-control formInput border border-danger" placeholder="Enter client instraction" name="instraction" cols="30"
                                    rows="3">{!! $customer?->instraction !!}</textarea>
                                @error('instraction')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row gx-3">

                    </div>
                    <div class="mt-4">
                        <button type="button" class="submit btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm
                        </button>
                        {{-- <a href="{{ route('admin.vehicle.product.index') }}" class="btn btn-default">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                        </a> --}}
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
            $('.merchant').on('change', function() {
                var merchant = $('.merchant').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.vehicle.product.create') }}',
                    dataType: 'json',
                    data: {
                        merchant: merchant,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#codes').html(response.options);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.edition').on('change', function() {
                var edition = $('.edition').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.vehicle.product.create') }}',
                    dataType: 'json',
                    data: {
                        edition: edition,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var featuresDetail = response.features.detail_feature;
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

                        featuresDetail.forEach(function(detailFeature) {
                            var featureTitle = detailFeature.feature.title;
                            var featureId = detailFeature.feature.id;

                            if (!uniqueFeatures.includes(featureTitle)) {
                                var featureItemDiv = $('<div>').addClass('col-lg-3');
                                var featureTitleElement = $('<h5>').addClass(
                                    'featureTitle mt-3').text(featureTitle);

                                featureItemDiv.append(featureTitleElement);
                                uniqueFeatures.push(featureTitle);

                                featuresDetail.forEach(function(df) {
                                    if (df.feature.title === featureTitle) {
                                        var checkbox = $('<input>').attr({
                                            type: 'checkbox',
                                            value: df.detail.id,
                                            name: 'detail[' +
                                                featureId + '][]'
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
            var edition = $(this).val();

            $.ajax({
                type: 'GET',
                url: '{{ route('admin.vehicle.product.create') }}',
                dataType: 'json',
                data: {
                    edition: edition,
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

    <script>
        $(document).ready(function() {
            var attributes = [
                '.brands', '.condition',
                '.skeleton',
                '.transmission', '.model', '.manufacture', '.color', '.grade', '.available', '.registration',
                '.fuel',
                '.edition', '.feature'
            ];

            attributes.forEach(function(e) {
                $(e).select2({
                    placeholder: 'Enter ' + e.substring(
                        1)
                });
            });
        });
    </script>

    <script>
        var input = document.querySelectorAll('.formInput');
        input.forEach((element, index) => {
            element.addEventListener('keyup', function() {
                if (event.key === "Enter") {
                    input[index + 1].focus()
                }
            })
        });

        var submit = document.querySelector('.submit')
        submit.addEventListener('focus', function() {
            this.type = "submit"
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.red-border').select2();
            $('.red-border').next('.select2-container').find('.select2-selection--multiple').css('border',
                '1px solid red');
        });
    </script>
@endpush
