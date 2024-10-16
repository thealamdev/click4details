<div class="row">
    <label for="basic_info" class="fs-5 fw-900">Basic infos</label>
    @if ($requirement->name)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Name</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->name }}</p>
        </div>
    @endif
    @if ($requirement->mobile)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Mobile</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->mobile }}</p>
        </div>
    @endif
    @if ($requirement->email)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Email</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->email }}</p>
        </div>
    @endif

</div>
<hr>

<div class="row">
    <label for="basic_info" class="fs-5 fw-900">Budget Info</label>
    @if ($requirement?->budget_from && $requirement?->budget_to)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Budget</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement?->budget_from . '-' . $requirement?->budget_to }}</p>
        </div>
    @endif

    @if ($requirement?->budget_from && $requirement?->budget_to)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Ready Budget</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">
                {{ $requirement?->ready_budget_from . '-' . $requirement?->ready_budget_to }}</p>
        </div>
    @endif
</div>
<hr>

<div class="row">
    <label for="basic_info" class="fs-5 fw-900">Loan Info</label>
    @if ($requirement?->loan)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Loan</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement?->loan }}</p>
        </div>
    @endif

    @if ($requirement?->loan_amount)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Loan Amount</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">
                {{ $requirement?->loan_amount }}</p>
        </div>
    @endif
    @if ($requirement?->self_pay)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Self Pay</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">
                {{ $requirement?->self_pay }}</p>
        </div>
    @endif
    @if ($requirement?->income)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Ready Budget</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">
                {{ $requirement?->loan_amount }}</p>
        </div>
    @endif
    @if ($requirement?->company_transaction)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Bank transaction</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">
                {{ $requirement?->company_transaction }}</p>
        </div>
    @endif
</div>
<hr>

<div class="row">
    <label for="performance_info" class="fs-5 fw-900">Performance info</label>
    @if ($requirement->level)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Level</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->level }}</p>
        </div>
    @endif

    @if ($requirement?->serious)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Seriousness</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->serious . ' %' }}</p>
        </div>
    @endif

    @if ($requirement?->profession)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Profession</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->profession }}</p>
        </div>
    @endif

    @if ($requirement?->frequency)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Car Change Frequency</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->frequency . 'in a year' }}</p>
        </div>
    @endif

    @if ($requirement?->purchase_date)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Last Purchase Date</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ date('d M, Y', strtotime($requirement->purchase_date)) }}</p>
        </div>
    @endif

    @if ($requirement?->location)
        <div class="col-lg-2 mb-2">
            <label class="fs-5 fw-400">Location</label>
            <br>
            <i class="d-inline-block ps-2 las la-arrow-right"></i>
            <p class="d-inline-block fs-6 fw-400">{{ $requirement->location }}</p>
        </div>
    @endif
</div>
<hr>

<div class="row">
    <label for="performance_info" class="fs-5 fw-900">Vehicle Info</label>
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
        <form
            action="{{ route('admin.vehicle.requirement.instructionUpdate', ['requirement' => $requirement?->id]) }}"
            method="POST">
            @method('put')
            @csrf
            <textarea class="form-control" name="instraction" cols="30" rows="5"> {!! $requirement?->instraction !!}</textarea>
            <button class="mt-2 btn btn-primary">Submit</button>
            <a class="btn btn-sm btn-success rounded mt-2" style="float: right"
                href="{{ route('admin.vehicle.requirement.edit', ['requirement' => $requirement?->id]) }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </form>
    </div>
</div>




<table class="table table-striped" style="width:100%;">
    <thead>
        <tr>
            <th class="align-middle">SL</th>
            <th width="350px" class="align-middle">Message</th>
            <th class="align-middle">Send Date</th>
            <td class="align-middle">Status</td>
            <th class="align-middle">Action</th>
        </tr>
    </thead>

    <tbody>
        @if (is_object($customerDetails) && $customerDetails->count() > 0)
            @foreach ($customerDetails as $n => $each)
                <tr class="removeItem{{ $each->id }}">
                    <td class="fw-500 text-center">
                        {{ str()->padLeft(++$n, 2, '0') }}
                    </td>

                    <td class="fw-500 text-start">
                        @if (date('d M , Y', strtotime($each?->send_date)) == date('d M , Y'))
                            <p class="text-info">{{ Str::limit($each?->message, 100, '...') }}</p>
                        @elseif ($each?->call_status == 1 && $each->send_status == 1)
                            <p class="text-success">{{ Str::limit($each?->message, 50, '...') }}</p>
                        @else
                            <p class="text-danger">{{ Str::limit($each?->message, 50, '...') }}</p>
                        @endif

                        @forelse ($each->customerFollowupMessageFeedback as $feedback)
                            <ul>
                                <li>{{ $feedback->message }}</li>
                            </ul>
                        @empty
                        @endforelse

                    </td>

                    <td>
                        {{ date('d M , Y', strtotime($each?->send_date)) }}
                    </td>


                    <td>
                        <form style="display: inline-block"
                            action="{{ route('admin.vehicle.followup.feedback-message.updateCallStatus', ['followup' => $each->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            @if ($each?->call_status == true)
                                <i
                                    class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>
                            @else
                                <button type="submit" {{ is_null($each->call_time) ? 'disabled' : '' }}
                                    class="btn btn-sm border border-slate-100">
                                    @if (is_null($each->call_time))
                                        --
                                    @else
                                        <i class="fa-solid fa-phone"></i>
                                    @endif
                                </button>
                            @endif
                        </form>
                        @if (is_null($each?->call_time))
                            <a href="{{ route('admin.vehicle.customer.followup-message.addCall', ['customer' => $each?->customer->id, 'customerFollowupMessage' => $each?->id]) }}"
                                class="fs-6 fw-900 text-dark-900 border border-slate-100 p-1 rounded"><i
                                    class="fa-solid fa-plus"></i></a>
                        @else
                            <a href="{{ route('admin.vehicle.customer.followup-message.removeCall', ['customer' => $each?->customer->id, 'customerFollowupMessage' => $each?->id]) }}"
                                class="fs-6 fw-900 text-dark-900 border border-slate-100 px-2 py-1 rounded">&times;</a>
                        @endif
                    </td>

                    <td>
                        {{-- <form style="display: inline-block"
                            action="{{ route('admin.vehicle.customer.followup-message.delete', ['customer' => $each->customer->id, 'customerFollowupMessage' => $each->id]) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" type="button" onclick="deleteItem(this)">
                                <i class="fa-solid fa-trash text-red-500"></i>
                            </button>
                        </form> --}}
                        <button class="btn" type="button"
                            deleteAction="{{ route('admin.vehicle.customer.followup-message.delete', ['customer' => $each->customer->id, 'customerFollowupMessage' => $each->id]) }}"
                            onclick="deleteItem(this,{{ $each->id }})">
                            <i class="fa-solid fa-trash text-red-500"></i>
                        </button>
                        <a title="#" id="bootModalShow"
                            formActionUrl={{ route('admin.vehicle.customer.followup-message.addFollowup', ['customer' => $each->customer->id, 'customerFollowupMessage' => $each?->id]) }}
                            class="p-1 border border-slate-100 rounded text-slate-900 darK:text-slate-100"
                            href="{{ route('admin.vehicle.customer.followup-message.addFollowup', ['customer' => $each->customer->id, 'customerFollowupMessage' => $each?->id]) }}">
                            <i class="fs-6 align-middle fa-solid fa-plus"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Sl</th>
            <th>Message</th>
            <th>Send Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
