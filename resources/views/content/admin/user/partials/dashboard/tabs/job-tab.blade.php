<div class="tab-pane fade show active" id="jobTab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-header d-flex justify-content-between">
                <label class="fs-5 fw-700 mb-3">
                    Today's Customers
                </label>
            </div>

            <div class="card-body reloadBody">
                <div class="row">
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

                    @if (is_object($schedule['schedule']) && count($schedule) > 0)
                        @foreach ($schedule['schedule'] as $each)
                            <div class="row">
                                <div class="col-lg-1 mt-4">
                                    @php
                                        $color = match (true) {
                                            $each?->serious >= 90 => '#015e01',
                                            $each?->serious >= 80 => '#036d03',
                                            $each?->serious >= 70 => '#1bac1b',
                                            $each?->serious >= 60 => '#06D001',
                                            $each?->serious >= 50 => '#3aee3a',
                                            $each?->serious >= 40 => '#9BEC00',
                                            $each?->serious >= 30 => '#e44236',
                                            $each?->serious >= 20 => '#e62518',
                                            $each?->serious >= 10 => '#fa1100',
                                            default => '#ff0000',
                                        };
                                    @endphp
                                    <p style="color: {{ $color }}">{{ $each->customer_id }}</p>
                                </div>
                                <div class="col-lg-1">
                                    @if ($each?->customer?->name !== null)
                                        <label class="fs-6 fw-500">{{ $each?->customer?->name }}</label>
                                        <span class="fs-6 fw-400">{{ $each?->customer?->mobile }}</span>
                                        <a id="bootModalShow" class="btn p-1 border border-slate-100 rounded text-slate-900 darK:text-slate-100" formActionUrl={{ route('admin.vehicle.customer.followup-message.store', ['customer' => $each?->customer->id]) }} href="{{ route('admin.vehicle.customer.followup-message.edit', ['customer' => $each?->customer->id]) }}"><i class="fs-6 align-middle fa-solid fa-plus"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-lg-4">
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

                                <div class="col-lg-1 mt-1">
                                    @if ($each?->message !== null)
                                        <a class="border border-slate-400 rounded px-2 py-1" action="{{ route('admin.vehicle.followup.feedback-message.updateMessageStatus', ['followup' => $each->id]) }}" onclick="updateMessage(this)" style="display: inline-block;" href="https://wa.me/+88{{ $each?->customer?->mobile }}/?text={{ urlencode($each?->message) }}" target="__blank">
                                            <i class="text-success fa-brands fa-whatsapp"></i>
                                        </a>
                                    @else
                                        --
                                    @endif
                                </div>

                                <div class="col-lg-2 text-center">
                                    {{ !empty($each?->send_date) ? date('d M , Y', strtotime($each?->send_date)) : '--' }}
                                    <br>
                                    {{ !empty($each?->message_send_time) ? date('H:i A', strtotime($each?->message_send_time)) : '--' }}
                                </div>

                                <div class="col-lg-1 mt-1">
                                    <form action="{{ route('admin.vehicle.followup.feedback-message.updateCallStatus', ['followup' => $each->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        @if ($each?->call_status == true)
                                            <i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-300 p-1 rounded"></i>
                                        @else
                                            <button type="submit" {{ is_null($each->call_time) ? 'disabled' : '' }} class="btn btn-sm border border-slate-300">
                                                @if (is_null($each->call_time))
                                                    --
                                                @else
                                                    <i class="fa-solid fa-phone"></i>
                                                @endif
                                            </button>
                                        @endif
                                    </form>
                                </div>

                                <div class="col-lg-1 mt-1">
                                    <a id="bootModalShow" formActionUrl={{ route('admin.vehicle.followup.feedback-message.store', ['followup' => $each->id]) }} class="btn btn-sm border border-slate-300 rounded-circle" href="{{ route('admin.vehicle.followup.feedback-message.create', ['followup' => $each?->id]) }}">
                                        <i class="fs-6 align-middle fa-solid fa-plus"></i>
                                    </a>
                                </div>

                                <div class="col-lg-1 mt-2">
                                    @if (!empty($each->send_date) && !empty($each->call_time))
                                        @if ($each?->send_status == 1 && $each?->call_status == 1)
                                            <i class="fs-4 text-success fa-regular fa-circle-check"></i>
                                        @else
                                            <i class="fs-4 text-danger fa-solid fa-circle-xmark"></i>
                                        @endif
                                    @elseif (empty($each->send_date) && !empty($each->call_time))
                                        @if ($each?->call_status == 1)
                                            <i class="fs-4 text-success fa-regular fa-circle-check"></i>
                                        @else
                                            <i class="fs-4 text-danger fa-solid fa-circle-xmark"></i>
                                        @endif
                                    @elseif (!empty($each->send_date) && empty($each->call_time))
                                        @if ($each?->send_status == 1)
                                            <i class="fs-4 text-success fa-regular fa-circle-check"></i>
                                        @else
                                            <i class="fs-4 text-danger fa-solid fa-circle-xmark"></i>
                                        @endif
                                    @endif

                                    <a id="detailModalShow" formActionUrl={{ $each->customer?->id }} href="{{ route('admin.user.detail', ['customer' => $each->customer?->id]) }}">
                                        <i class="fs-4 fa-solid fa-circle-info text-black-400"></i>
                                    </a>
                                </div>

                                <hr style="margin-top:10px">
                            </div>
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
