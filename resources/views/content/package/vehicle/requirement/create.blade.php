@extends('layouts.master')
@section('title', 'Create Recuirements')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Customer Recuirement</h4>
                <p>Prior to create resource, make sure asterisk () signs are filled</p>
            </div>

            <div>
                <h4 class="mb-0">
                    <a href="{{ route('admin.vehicle.requirement.index') }}" class="btn btn-success">
                        All Requirements
                    </a>
                </h4>
            </div>
        </div>

        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('admin.vehicle.requirement.store') }}" method="POST" accept-charset="utf-8"
                    autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    <h4>Client Details-->Basic Info</h4>
                    <input type="hidden" name="user_id" value="{{ auth()->user()?->id }}">
                    <div class="row gx-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="name">Client Name<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="text" class="form-control formInput border border-danger"
                                    placeholder="Enter Client Name" name="name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="mobile">Client Mobile<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="number" class="form-control formInput border border-danger"
                                    placeholder="Enter Client Mobile" name="mobile" value="{{ old('mobile') }}" />
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
                                    name="email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- vehicle infos -->
                    <h4>Vehicle Info</h4>
                    <div class="row gx-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="brand">
                                    Brand
                                    <span class="ms-1 text-red-600">

                                    </span>
                                </label>

                                <select class="form-select formInput brands @error('brand') {{ 'is-invalid' }} @enderror"
                                    name="brand[]" multiple="multiple">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeBrand as $each)
                                        <option value="{{ $each->title }}" @selected(old('brand') == $each->id)>
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
                                    class="form-select formInput skeleton @error('skeleton') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="skeleton[]" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeSkeleton as $each)
                                        <option value="{{ $each->title }}" @selected(old('skeleton') == $each->id)>
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
                                        <option value="{{ $each->title }}" @selected(old('model') == $each->id)>
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
                                        <option value="{{ $each->title }}" @selected(old('transmission') == $each->id)>
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
                                        <option value="{{ $i }}" @selected(old('manufacture') == $i)>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('registration')
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
                                        <option value="{{ $each->title }}" @selected(old('available') == $each->id)>
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
                                            {{ old('edition') == $each->id ? 'selected' : '' }}>
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
                                        <option value="{{ $each->title }}" @selected(old('fuel') == $each->id)>
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
                                    class="form-control formInput @error('engine_end') {{ 'is-invalid' }} @enderror">

                                @error('engine_end')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="condition">
                                    <span class="ms-1 text-red-600">
                                        Condition
                                    </span>
                                </label>
                                <select
                                    class="form-select formInput red-border condition @error('condition') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="condition[]">
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeCondition as $each)
                                        <option value="{{ $each->title }}" @selected(old('condition') == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>
                                @error('condition')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg col-md-6"></div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="registration">Registration<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select registration formInput @error('registration') {{ 'is-invalid' }} @enderror"
                                    multiple="multiple" name="registration[]">
                                    <option disabled>Please Select...</option>
                                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                                        <option value="{{ $i }}" @selected(old('registration') == $i)>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('registration')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg col-md-6"></div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="color">Color<span
                                        class="ms-1 text-red-600"></span></label>
                                <select
                                    class="form-select red-border formInput color @error('color') {{ 'is-invalid' }} @enderror"
                                    name="color[]" multiple="multiple" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeColor as $each)
                                        <option value="{{ $each->title }}" @selected(old('color') == $each->id)>
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
                                        <option value="{{ $each->title }}" @selected(old('feature') == $each->id)>
                                            {{ $each->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="grade">Grade<span
                                        class="ms-1 text-red-600"></span>
                                </label>

                                <select
                                    class="form-select red-border formInput grade @error('grade') {{ 'is-invalid' }} @enderror"
                                    name="grade[]" multiple="multiple" required>
                                    <option disabled>Please Select...</option>
                                    @foreach ($composeGrade as $each)
                                        <option value="{{ $each->title }}" @selected(old('grade') == $each->id)>
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

                    <!-- Client details infos -->
                    <h4>Client Details-->Budget Info</h4>
                    <div class="row gx-3">

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-5 pr-0">
                                    <label for="budget_from">Budget from(Lakh)</label>
                                    <select name="budget_from" class="form-control border border-danger formInput">
                                        <option selected disabled>--budget from--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-lg-2 d-flex justify-content-center align-items-center p-0 mt-4">
                                    <span><i class="fa-solid fa-rotate fs-5"></i></span>
                                </div>

                                <div class="col-lg-5 pl-0">
                                    <label for="budget_to">Budget to(Lakh)</label>
                                    <select name="budget_to" class="form-control border border-danger formInput">
                                        <option selected disabled>--budget to--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-5 pr-0">
                                    <label for="ready_budget_from">Reday Budget from(Lakh)</label>
                                    <select name="ready_budget_from" class="form-control border border-danger formInput">
                                        <option selected disabled>--Ready budget from--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-lg-2 d-flex justify-content-center align-items-center p-0 mt-4">
                                    <span><i class="fa-solid fa-rotate fs-5"></i></span>
                                </div>

                                <div class="col-lg-5 pl-0">
                                    <label for="ready_budget_to">Reday Budget to(Lakh)</label>
                                    <select name="ready_budget_to" class="form-control border border-danger formInput">
                                        <option selected disabled>--Ready budget to--</option>
                                        @for ($i = 5; $i <= 300; $i += 5)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <!-- Client loan infos -->
                    <h4>Client Details --> Loan Info</h4>
                    <div class="row gx-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="loan">Interested for Loan<span
                                        class="ms-1 text-red-600"></span></label>
                                <select name="loan" class="form-control formInput" value="{{ old('loan') }}"
                                    required>
                                    <option disabled selected>--select option--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>

                                @error('loan')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="bank_loan">Bank Loan Amount(Lakh)<span
                                        class="ms-1 text-red-600"></span></label>
                                {{-- <input type="number" class="form-control formInput"
                                    placeholder="Enter client bank loan amount" name="bank_loan"
                                    value="{{ old('bank_loan') }}" required /> --}}
                                <select name="bank_loan" class="form-control formInput">
                                    <option selected disabled>--Bank loan amount (%)--</option>
                                    @for ($i = 10; $i <= 100; $i += 10)
                                        <option value="{{ $i }}">{{ $i }} %</option>
                                    @endfor
                                </select>
                                @error('bank_loan')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="self_pay">Self Pay Amount(%)<span
                                        class="ms-1 text-red-600"></span></label>
                                {{-- <input type="number" class="form-control formInput"
                                    placeholder="Enter client Self Pay Amount" name="self_pay"
                                    value="{{ old('self_pay') }}" required /> --}}

                                <select name="self_pay" class="form-control formInput">
                                    <option selected disabled>--self payment amount--</option>
                                    @for ($i = 10; $i <= 100; $i += 10)
                                        <option value="{{ $i }}">{{ $i }} %</option>
                                    @endfor
                                </select>
                                @error('self_pay')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="income">Client Income<span
                                        class="ms-1 text-red-600"></span></label>
                                {{-- <input type="number" class="form-control formInput" placeholder="Enter client income"
                                    name="income" value="{{ old('income') }}" required /> --}}

                                <select name="income" class="form-control formInput">
                                    <option selected disabled>--Client income(Lakh)--</option>
                                    @for ($i = 1; $i <= 1000; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
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
                                    value="{{ old('company_transaction') }}" required />
                                @error('company_transaction')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Client Performance infos -->
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
                                    <option value="vvip">VVIP</option>
                                    <option value="vip">VIP</option>
                                    <option value="high">High</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="not_knowns">Not Known</option>
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
                                {{-- <input type="number" class="form-control formInput border border-danger"
                                    placeholder="Enter client seriousness" name="serious" value="{{ old('serious') }}"
                                    required /> --}}
                                <select name="serious" class="form-control formInput">
                                    <option selected disabled>--Client Seriousness(%)--</option>
                                    @for ($i = 0; $i <= 100; $i += 10)
                                        <option value="{{ $i }}">{{ $i }} %</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="profession">Client Profession<span
                                        class="ms-1 text-red-600"></span></label>
                                <input type="text" class="form-control formInput"
                                    placeholder="Enter client profession" name="profession"
                                    value="{{ old('profession') }}" required />
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
                                    name="frequency" value="{{ old('frequency') }}" required />
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
                                    value="{{ old('purchase_date') }}" required />
                                @error('purchase_date')
                                    <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="location">Client Location<span
                                        class="ms-1 text-red-600"></span></label>
                                {{-- <input type="text" class="form-control formInput border border-danger"
                                    placeholder="Enter client location" name="location" value="{{ old('location') }}"
                                    required /> --}}
                                <select name="location" class="form-control location formInput border border-danger">
                                    <option disabled selected>--select location--</option>
                                    @foreach ($areas as $each)
                                        <option value="{{ $each }}">{{ $each }}</option>
                                    @endforeach
                                </select>
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
                                <textarea class="form-control formInput border border-danger" placeholder="Enter client instraction"
                                    name="instraction" cols="30" rows="3"></textarea>
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
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Next
                        </button>
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
            var attributes = [
                '.brands', '.condition',
                '.skeleton',
                '.transmission', '.model', '.manufacture', '.color', '.grade', '.available', '.registration',
                '.fuel',
                '.edition', '.feature', '.location'
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
