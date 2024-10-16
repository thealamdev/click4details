<div class="tab-pane fade" id="completeTab">
    <div class="row">
        <div class="col-lg-12">

            <div class="card-header d-flex justify-content-between">
                <label class="fs-5 fw-700 mb-3">
                    Completed Customers
                </label>
            </div>

            <div class="card-body">
                <div class="row reloadBody">
                    <div class="col-lg-1">
                        <label class="fs-6 fw-700">Name</label>
                    </div>
                    <div class="col-lg-5">
                        <label class="fs-6 fw-700">Messages</label>
                    </div>

                    <div class="col-lg-1">
                        <label class="fs-6 fw-700">What'sApp</label>
                    </div>

                    <div class="col-lg-2 text-center">
                        <label class="fs-6 fw-700">Message Send Time</label>
                    </div>

                    <div class="col-lg-1">
                        <label title="Call" class="fs-6 fw-700">Call</label>
                    </div>

                    <div class="col-lg-1">
                        <label title="Feedback" class="fs-6 fw-700">Feedback</label>
                    </div>
                    <div class="col-lg-1">
                        <label title="Status" class="fs-6 fw-700">Status</label>
                    </div>
                    <hr>

                    @if (is_object($completedJobs) && count($completedJobs) > 0)
                        @foreach ($completedJobs as $each)
                            <div class="col-lg-1">
                                @if ($each?->customer?->name !== null)
                                    <label class="fs-6 fw-500">{{ $each?->customer?->name }}</label>
                                    <span class="fs-6 fw-400">{{ $each?->customer?->mobile }}</span>
                                    <a id="bootModalShow"
                                        class="btn p-1 border border-slate-100 rounded text-slate-900 darK:text-slate-100"
                                        formActionUrl={{ route('admin.vehicle.customer.followup-message.store', ['customer' => $each?->customer->id]) }}
                                        href="{{ route('admin.vehicle.customer.followup-message.edit', ['customer' => $each?->customer->id]) }}"><i
                                            class="fs-6 align-middle fa-solid fa-plus"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="col-lg-5">
                                @if ($each?->message !== null)
                                    <label class="fs-6 fw-500">{{ Str::limit(optional($each)->message, 100, '...') }}
                                    </label>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if (is_object($each?->customerFollowupMessageFeedback) && count($each?->customerFollowupMessageFeedback) > 0)
                                            <ul style="list-style-type: none">
                                                @foreach ($each->customerFollowupMessageFeedback as $feedback)
                                                    <li class="fs-6 fw-400 px-2 pt-2">
                                                        <div class="arrow-container">
                                                            <div class="arrow"></div>
                                                        </div>
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

                            <div class="col-lg-1">
                                <div class="d-flex">
                                    @if ($each?->message !== null)
                                        <a class="border border-slate-300 px-2 py-1 rounded d-inline-block me-2 align-middle"
                                            href="https://wa.me/+88{{ $each?->customer?->mobile }}/?text={{ urlencode($each?->message) }}"><i
                                                class="text-success fa-brands fa-whatsapp"></i>
                                        </a>
                                    @else
                                        --
                                    @endif

                                    <form
                                        action="{{ route('admin.vehicle.followup.feedback-message.updateMessageStatus', ['followup' => $each->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        @if ($each?->call_status == true)
                                            <i
                                                class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-300 p-1 rounded"></i>
                                        @else
                                            <button type="submit" {{ is_null($each->call_time) ? 'disabled' : '' }}
                                                class="btn btn-sm border border-slate-300 p-1">
                                                @if (is_null($each->call_time))
                                                    --
                                                @else
                                                    <i class="fa-solid fa-phone"></i>
                                                @endif
                                            </button>
                                        @endif
                                    </form>
                                </div>

                            </div>

                            <div class="col-lg-2 text-center">
                                {{ !empty($each?->send_date) ? date('d M , Y', strtotime($each?->send_date)) : '--' }}
                                <br>
                                {{ !empty($each?->message_send_time) ? date('H:i A', strtotime($each?->message_send_time)) : '--' }}
                            </div>


                            <div class="col-lg-1">
                                <form
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
                            </div>

                            <div class="col-lg-1">
                                <a id="bootModalShow"
                                    formActionUrl={{ route('admin.vehicle.followup.feedback-message.store', ['followup' => $each->id]) }}
                                    class="btn border border-slate-300 rounded-circle"
                                    href="{{ route('admin.vehicle.followup.feedback-message.create', ['followup' => $each?->id]) }}">
                                    <i class="fs-6 align-middle fa-solid fa-plus"></i>
                                </a>
                            </div>

                            <div class="col-lg-1 mt-2">
                                @if ($each?->send_status == true && ($each?->call == false || $each?->call_status == true))
                                    <i class="fs-4 text-success fa-regular fa-circle-check"></i>
                                @else
                                    <i class="fs-4 text-danger fa-solid fa-circle-xmark"></i>
                                @endif
                            </div>

                            <hr style="margin-top:10px">
                        @endforeach
                    @else
                        <label class="fs-3 fw-900 text-center pb-3">কোন কাজ নাই</label>
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage/img/no-job.png') }}" alt="#">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
