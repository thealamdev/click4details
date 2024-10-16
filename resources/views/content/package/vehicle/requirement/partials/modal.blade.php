<div class="modal fade detail{{ $each?->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    @php
        $requirement = $requirements?->where('id', $each->id)->first();
    @endphp
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Requirement of
                    {{ $requirement?->name }}, Mobile: {{ $requirement?->mobile }}
                    From: {{ $requirement?->location }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="basic_info" class="fs-5 fw-900">Basic infos</label>
                    @if ($requirement?->name)
                        <div class="col-lg-2 mb-2">
                            <label class="fs-5 fw-400">Name</label>
                            <br>
                            <i class="d-inline-block ps-2 las la-arrow-right"></i>
                            <p class="d-inline-block fs-6 fw-400">{{ $requirement->name }}</p>
                        </div>
                    @endif
                    @if ($requirement?->mobile)
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
                            <p class="d-inline-block fs-6 fw-400">
                                {{ $requirement?->budget_from . '-' . $requirement?->budget_to }}</p>
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
                            <p class="d-inline-block fs-6 fw-400">
                                {{ date('d M, Y', strtotime($requirement->purchase_date)) }}</p>
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

                <label class="fs-5 fw-500">Special instruction</label>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('admin.vehicle.requirement.instructionUpdate', ['requirement' => $each?->id]) }}" method="POST">
                            @method('put')
                            @csrf
                            <textarea class="form-control" name="instraction" cols="30" rows="5"> {!! $requirement?->instraction !!}</textarea>
                            <button class="mt-2 btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- Follow up part !-->
                <hr>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header d-flex justify-content-between">
                            <label for="followup">Follow Up & Feedback of
                                {{ $requirement?->name }}
                            </label>

                            <a id="bootModalShow" class="btn btn-sm btn-success" formActionUrl={{ route('admin.vehicle.customer.followup-message.store', ['customer' => $requirement?->id]) }} href="{{ route('admin.vehicle.customer.followup-message.edit', ['customer' => $requirement?->id]) }}"><i class="fs-6 align-middle fa-solid fa-plus"></i>
                            </a>
                        </div>

                        <!-- followup feedback table start  -->
                        <div class="card-body reloadBody">
                            <div class="row">
                                <div class="col-lg-1 text-center">
                                    <label class="fs-6 fw-700">Send Time</label>
                                </div>

                                <div class="col-lg-5">
                                    <label class="fs-6 fw-700">Messages</label>
                                </div>

                                <div class="col-lg-1">
                                    <label class="fs-6 fw-700">WhatsApp</label>
                                </div>

                                <div class="col-lg-1">
                                    <label title="Call" class="fs-6 fw-700">Call at</label>
                                </div>

                                <div class="col-lg-1">
                                    <label title="Feedback" class="fs-6 fw-700">Feedback</label>
                                </div>

                                <div class="col-lg-1">
                                    <label title="Status" class="fs-6 fw-700">Action</label>
                                </div>

                                <div class="col-lg-1">
                                    <label title="Status" class="fs-6 fw-700">Visit</label>
                                </div>

                                <div class="col-lg-1">
                                    <label title="Status" class="fs-6 fw-700">Status</label>
                                </div>

                                <hr>

                                @foreach ($requirement?->customerFollowupMessage as $followup)
                                    <div class="row removeItem{{ $followup->id }}">

                                        <div class="col-lg-1 text-center">
                                            {{ !empty($followup?->send_date) ? date('d M , Y ', strtotime($followup?->send_date)) : '--' }}
                                        </div>

                                        <div class="col-lg-5">
                                            @if ($followup->after_visit == '1')
                                                <p class="text-success">After visit</p>
                                            @endif
                                            @if ($followup?->message !== null)
                                                {!! Str::limit(optional($followup)->message, 100, '...') !!}
                                                <br>
                                                @isset($followup?->note)
                                                   <span class="text-success">Note:- </span> {!! Str::limit(optional($followup)->note, 100, '...') !!}
                                                @endisset
                                            @endif
                                            <div class="row reloadItem">
                                                <div class="col-lg-12">

                                                    @if (is_object($followup->customerFollowupMessageFeedback) && count($followup->customerFollowupMessageFeedback) > 0)
                                                        <ul style="list-style-type: disc">
                                                            @foreach ($followup->customerFollowupMessageFeedback as $feedback)
                                                                <li class="fs-6 fw-400 px-2 pt-2">
                                                                    <div class="feedback-message">
                                                                        {{ $feedback->message }}{{ !empty($feedback->set_time) ? ' ' . date('d M, Y', strtotime($feedback->set_time)) : '' }}
                                                                        {{ $feedback->budget }}
                                                                        <span class="ps-5 fs-6 fw-400 text-primary">
                                                                            <i class="fa-regular fa-clock"></i>
                                                                            {{ date('d M, Y', strtotime($feedback->created_at)) }}
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-1 d-flex mt-2 align-items-start">
                                            @if ($followup && $followup->message !== null)
                                                <a class="inline-block btn btn-sm border border-slate-100" href="https://wa.me/+88{{ $followup->customer->mobile }}/?text={{ urlencode($followup->message) }}">
                                                    <i class="text-success fa-brands fa-whatsapp"></i>
                                                </a>
                                            @else
                                                --
                                            @endif

                                            <form class="inline-block mb-0 mx-2" action="{{ route('admin.vehicle.followup.feedback-message.updateMessageStatus', ['followup' => $followup->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                @if ($followup && $followup->send_status == true)
                                                    <i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>
                                                @else
                                                    <button type="submit" class="btn btn-sm border border-slate-100"><i class="las la-paper-plane"></i></button>
                                                @endif
                                            </form>
                                        </div>

                                        <div class="col-lg-1 mt-2">

                                            <form action="{{ route('admin.vehicle.followup.feedback-message.updateCallStatus', ['followup' => $followup->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                @if ($followup?->call_status == true)
                                                    <i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>
                                                @else
                                                    <button type="submit" {{ is_null($followup->call_time) ? 'disabled' : '' }} class="btn btn-sm border border-slate-100">
                                                        @if (is_null($followup->call_time))
                                                            --
                                                        @else
                                                            <i class="fa-solid fa-phone"></i>
                                                        @endif
                                                    </button>
                                                @endif
                                            </form>
                                            @if (is_null($followup?->call_time))
                                                <button onclick="addCall(this)" route="{{ route('admin.vehicle.customer.followup-message.addCall', ['customer' => $requirement->id, 'customerFollowupMessage' => $followup?->id]) }}" class="bg-transparent fs-6 fw-900 text-dark-900 border border-slate-100 p-1 rounded">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            @else
                                                <a href="{{ route('admin.vehicle.customer.followup-message.removeCall', ['customer' => $requirement->id, 'customerFollowupMessage' => $followup?->id]) }}" class="fs-6 fw-900 text-dark-900 border border-slate-100 px-2 py-1 rounded">&times;</a>
                                            @endif

                                        </div>

                                        <div class="col-lg-1 mt-2 text-center">
                                            <a title="{{ $requirement?->name }}" id="bootModalShow" formActionUrl={{ route('admin.vehicle.followup.feedback-message.store', ['followup' => $followup?->id]) }} class="p-1 border border-slate-100 rounded text-slate-900 darK:text-slate-100" href="{{ route('admin.vehicle.followup.feedback-message.create', ['followup' => $followup?->id]) }}">
                                                <i class="fs-6 align-middle fa-solid fa-plus"></i>
                                            </a>
                                        </div>

                                        <div class="col-lg-1">
                                            {{-- <form
                                            action="{{ route('admin.vehicle.customer.followup-message.delete', ['customer' => $each->id, 'customerFollowupMessage' => $followup->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn" type="button"
                                                onclick="deleteItem(this)">
                                                <i class="fa-solid fa-trash text-red-500"></i>
                                            </button>
                                            </form> --}}

                                            <button class="btn" type="button" deleteAction="{{ route('admin.vehicle.customer.followup-message.delete', ['customer' => $each->id, 'customerFollowupMessage' => $followup->id]) }}" onclick="deleteItem(this,{{ $followup->id }})">
                                                <i class="fa-solid fa-trash text-red-500"></i>
                                            </button>

                                            <a title="{{ $requirement?->name }}" id="bootModalShow" formActionUrl={{ route('admin.vehicle.customer.followup-message.addFollowup', ['customer' => $each->id, 'customerFollowupMessage' => $followup?->id]) }} class="p-1 border border-slate-100 rounded text-slate-900 darK:text-slate-100" href="{{ route('admin.vehicle.customer.followup-message.addFollowup', ['customer' => $each->id, 'customerFollowupMessage' => $followup?->id]) }}">
                                                <i class="fs-6 align-middle fa-solid fa-plus"></i>
                                            </a>

                                        </div>

                                        <div class="col-lg-1 mt-1 text-center">
                                            @if ($followup->visited_at == '1')
                                                <p>Visited</p>
                                                <a href="#" onclick="visitForm({{ $followup->id }})">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @else
                                                <a href="#" onclick="visitForm({{ $followup->id }})">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="col-lg-1 mt-1 text-center">
                                            <i class="text-danger fa-solid fa-circle-xmark"></i>
                                        </div>

                                        <!-- visit followup form design start !-->
                                        <div class="visitForm{{ $followup->id }}" style="display:none">
                                            <hr style="margin-bottom: 12px;">
                                            {{-- <form class="submitFormItem" action="{{ route('admin.vehicle.customer.followup-message.visitFollowupStore', ['customer' => $requirement?->id, 'customerFollowupMessage' => $followup->id]) }}" method="POST">
                                                @csrf
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4>Visit followup</h4>
                                                </div>
                                                <div id="formItemsContainer{{ $followup->id }}">
                                                    <div class="row formItemContainer p-4 m-auto border border-slate-300 rounded mb-3">

                                                        <div class="message-container">
                                                            <div class="col-lg-12 mb-3 messageMainDiv" style="display: block;">
                                                                <input type="text" name="message[]" placeholder="Enter the message" class="form-control">
                                                            </div>

                                                            <div class="mb-3 messageIdDiv" style="display: none;">
                                                                <label for="package">Custom message (if
                                                                    needed)</label>
                                                                <input type="text" name="message[]" placeholder="Enter the custom message" class="form-control">
                                                            </div>
                                                        </div>

                                                        <!-- Assuming you have a container to append new form items -->
                                                        <div id="formItemsContainer"></div>


                                                        <div class="col-lg-6">
                                                            <input type="date" name="send_date[]" placeholder="Enter the date" class="form-control">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="time" name="call_time[]" placeholder="Enter the call info" class="form-control">
                                                        </div>
                                                        <div class="col-lg-12 text-center mt-3">
                                                            <button type="button" class="btn btn-secondary addItem" data-requirement-id="{{ $followup->id }}">
                                                                +
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12 text-end">
                                                        <button class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>

                                            </form> --}}
                                            <form class="submitFormItem" action="{{ route('admin.vehicle.customer.followup-message.visitFollowupStore', ['customer' => $requirement?->id, 'customerFollowupMessage' => $followup->id]) }}" method="POST">
                                                @csrf
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4>Visit followup</h4>
                                                </div>
                                                <div id="formItemsContainer{{ $followup->id }}">

                                                    @for ($count = 1; $count <= $formLenCount; $count++)
                                                        <div class="row formItemContainer p-4 m-auto border border-slate-300 rounded mb-3">
                                                            <div class="message-container">
                                                                <div class="col-lg-12 mb-3 messageMainDiv">
                                                                    <select name="message[]" class="form-control">
                                                                        <option selected disabled>-- Select a message --</option>
                                                                        @foreach ($followups as $followup)
                                                                            <option value="{{ $followup->message }}">{{ $followup->message }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 messageIdDiv">
                                                                    <label for="note">Custom message (if needed)</label>
                                                                    <textarea class="form-control" name="note[]" id="" cols="30" rows="10" placeholder="Enter notes.."></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <input type="date" name="send_date[]" placeholder="Enter the date" class="form-control">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="time" name="call_time[]" placeholder="Enter the call info" class="form-control">
                                                            </div>

                                                        </div>
                                                    @endfor

                                                    <div class="col-lg-12 text-center mt-3">
                                                        <button type="button" class="btn btn-secondary addItem">+</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-end">
                                                        <button class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- visit followup form design end !-->
                                        <hr style="margin-top: 12px;">
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        <!-- followup feedback table end  -->
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>


        </div>
    </div>
</div>
