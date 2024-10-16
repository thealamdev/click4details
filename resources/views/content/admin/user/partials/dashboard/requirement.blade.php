<div class="row">
    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Brand</label>
        <br>
        @foreach ($requirement?->brandCustomer as $brand)
            <div style="height:20px">
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $brand->brand }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Model</label>
        <br>
        @foreach ($requirement?->carmodelCustomer as $model)
            <div style="height:20px">
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $model->model }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Model Year</label>
        <br>
        @foreach ($requirement?->customerManufacture as $manufacture)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $manufacture->manufacture }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Mileage</label>
        <br>
        @foreach ($requirement?->customerMileage as $mileage)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $mileage->mileage_start }}km</p>
                to
                <p class="fs-6 fw-400">-{{ $mileage->mileage_end }}km</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Engine</label>
        <br>
        @foreach ($requirement?->customerEngine as $engine)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $engine->engine_start }}km</p>
                to
                <p class="d-inline-block fs-6 fw-400">-{{ $engine->engine_end }}km</p>
            </div>
        @endforeach
    </div>

    {{-- @if ($requirement?->conditionCustomer->pluck('condition') == [null]) --}}
    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Condition</label>
        <br>
        @foreach ($requirement?->conditionCustomer as $condition)
            <div style="height:20px">
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $condition->condition }}</p>
            </div>
        @endforeach
    </div>
    {{-- @endif --}}

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Edition</label>
        <br>
        @foreach ($requirement?->customerEdition as $edition)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $edition->edition }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Fuel</label>
        <br>
        @foreach ($requirement?->customerFuel as $fuel)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $fuel->fuel }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Skeleton</label>
        <br>
        @foreach ($requirement?->customerSkeleton as $skeleton)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $skeleton->skeleton }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Transmission</label>
        <br>
        @foreach ($requirement?->customerTransmission as $transmission)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $transmission->transmission }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Available</label>
        <br>
        @foreach ($requirement?->availableCustomer as $available)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $available->available }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Registration</label>
        <br>
        @foreach ($requirement?->customerRegistration as $registration)
            <div>
                <i class=d-inline-block "ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $registration->registration }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Grade</label>
        <br>
        @foreach ($requirement?->customerGrade as $grade)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $grade->grade }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Color</label>
        <br>
        @foreach ($requirement?->colorCustomer as $color)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $color->color }}</p>
            </div>
        @endforeach
    </div>
    <div class="col-lg-2 mb-2">
        <label class="fs-5 fw-400">Skeleton</label>
        <br>
        @foreach ($requirement?->CustomerFeature as $feature)
            <div>
                <i class="d-inline-block ps-2 las la-arrow-right"></i>
                <p class="d-inline-block fs-6 fw-400">{{ $feature->feature }}</p>
            </div>
        @endforeach
    </div>
</div>

<label class="fs-5 fw-400">Special instruction</label>
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.vehicle.requirement.instructionUpdate', ['requirement' => $each?->id]) }}"
            method="POST">
            @method('put')
            @csrf
            <textarea class="form-control" name="instraction" cols="30" rows="5"> {!! $requirement?->instraction !!}</textarea>
            <button class="mt-2 btn btn-primary">Submit</button>
        </form>
    </div>
</div>
