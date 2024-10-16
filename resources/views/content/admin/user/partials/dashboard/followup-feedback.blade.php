<style>
    .arrow-container {
        position: relative;
        display: inline-block;
    }

    .arrow {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 20px;
        /* Width of the arrow */
        height: 100%;
        /* Initial height, will be auto-adjusted */
    }

    .arrow::before {
        content: '';
        position: absolute;
        top: 8px;
        left: 0;
        width: 0;
        height: 0;
        border-top: 10px solid transparent;
        /* Adjust as needed */
        border-bottom: 10px solid transparent;
        /* Adjust as needed */
        border-left: 10px solid #ccc;
        /* Adjust as needed */
    }

    .feedback-message {
        margin-left: 30px;
        /* Space for the arrow */
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card-header d-flex justify-content-between">
            <label for="followup">Follow Up & Feedback of
                {{ $requirement?->name }}
            </label>

            {{-- <a class="btn btn-sm btn-success"
                href="{{ route('admin.vehicle.customer.followup-message.create', ['customer' => $requirement?->id]) }}"><i
                    class="fs-6 align-middle fa-solid fa-plus"></i>
            </a> --}}

            <a id="bootModalShow" class="btn btn-sm btn-success"
                formActionUrl={{ route('admin.vehicle.customer.followup-message.store', ['customer' => $requirement?->id]) }}
                href="{{ route('admin.vehicle.customer.followup-message.edit', ['customer' => $requirement?->id]) }}"><i
                    class="fs-6 align-middle fa-solid fa-plus"></i>
            </a>
        </div>

        <!-- followup feedback table start  -->
        <div class="card-body">
            <div class="row reloadBody">
                <div class="col-lg-5">
                    <label class="fs-6 fw-700">Messages</label>
                </div>

                <div class="col-lg-1">
                    <label class="fs-6 fw-700">WhatsApp</label>
                </div>

                <div class="col-lg-2 text-center">
                    <label class="fs-6 fw-700">Message Send Time</label>
                </div>

                <div class="col-lg-1">
                    <label title="Call" class="fs-6 fw-700">Call at</label>
                </div>

                <div class="col-lg-1">
                    <label title="Feedback" class="fs-6 fw-700">Feedback</label>
                </div>

                <div class="col-lg-1">
                    <label title="Status" class="fs-6 fw-700">Status</label>
                </div>

                <div class="col-lg-1">
                    <label title="Status" class="fs-6 fw-700">Action</label>
                </div>
                <hr>

                @foreach ($requirement?->customerFollowupMessage as $followup)
                    <div class="col-lg-5">
                        @if ($followup?->message !== null)
                            {{ Str::limit(optional($followup)->message, 100, '...') }}
                        @endif
                        <div class="row reloadItem">
                            <div class="col-lg-12">

                                @if (is_object($followup->customerFollowupMessageFeedback) && count($followup->customerFollowupMessageFeedback) > 0)
                                    <ul style="list-style-type: none">
                                        @foreach ($followup->customerFollowupMessageFeedback as $feedback)
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

                    <div class="col-lg-1 d-flex mt-2 align-items-start">
                        @if ($followup && $followup->message !== null)
                            <a class="inline-block btn btn-sm border border-slate-100"
                                href="https://wa.me/+88{{ $followup->customer->mobile }}/?text={{ urlencode($followup->message) }}">
                                <i class="text-success fa-brands fa-whatsapp"></i>
                            </a>
                        @else
                            --
                        @endif

                        <form class="inline-block mb-0 mx-2"
                            action="{{ route('admin.vehicle.followup.feedback-message.updateMessageStatus', ['followup' => $followup->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            @if ($followup && $followup->send_status == true)
                                <i
                                    class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>
                            @else
                                <button type="submit" class="btn btn-sm border border-slate-100"><i
                                        class="las la-paper-plane"></i></button>
                            @endif
                        </form>
                    </div>


                    <div class="col-lg-2 text-center">
                        {{ !empty($followup?->send_date) ? date('d M , Y ', strtotime($followup?->send_date)) : '--' }}
                        <br>
                        {{ !empty($followup?->message_send_time) ? date('H:i A', strtotime($followup?->message_send_time)) : '--' }}
                    </div>

                    <div class="col-lg-1 mt-2">
                        <form
                            action="{{ route('admin.vehicle.followup.feedback-message.updateCallStatus', ['followup' => $followup->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            @if ($followup?->call_status == true)
                                <i
                                    class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>
                            @else
                                <button type="submit" {{ is_null($followup->call_time) ? 'disabled' : '' }}
                                    class="btn btn-sm border border-slate-100">
                                    @if (is_null($followup->call_time))
                                        --
                                    @else
                                        <i class="fa-solid fa-phone"></i>
                                    @endif
                                </button>
                            @endif
                        </form>
                    </div>

                    <div class="col-lg-1 mt-2">
                        <a title="{{ $requirement?->name }}" id="bootModalShow"
                            formActionUrl={{ route('admin.vehicle.followup.feedback-message.store', ['followup' => $followup?->id]) }}
                            class="p-1 border border-slate-100 rounded text-slate-900 darK:text-slate-100"
                            href="{{ route('admin.vehicle.followup.feedback-message.create', ['followup' => $followup?->id]) }}">
                            <i class="fs-6 align-middle fa-solid fa-plus"></i>
                        </a>
                    </div>

                    <div class="col-lg-1 mt-2">
                        @if ($followup?->send_status == true && ($followup?->call == false || $followup?->call_status == true))
                            <i class="text-success fa-regular fa-circle-check"></i>
                        @else
                            <i class="text-danger fa-solid fa-circle-xmark"></i>
                        @endif
                    </div>

                    <div class="col-lg-1">
                        <form
                            action="{{ route('admin.vehicle.customer.followup-message.delete', ['customer' => $each->id, 'customerFollowupMessage' => $followup->id]) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" type="button" onclick="deleteItem(this)">
                                <i class="fa-solid fa-trash text-red-500"></i>
                            </button>
                        </form>

                    </div>
                    <hr style="margin-top: 12px;">
                @endforeach

            </div>
        </div>
        <!-- followup feedback table end  -->
    </div>
</div>
