<table id="dataTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th class="align-middle">Sl</th>
            <th class="align-middle">Customer Name</th>
            <th class="align-middle">Customer Mobile</th>
            <th class="align-middle">Message</th>
            <th class="align-middle">Status</th>
            <th class="align-middle">WhatsApp</th>
            <th class="align-middle">Call</th>
            <th class="align-middle">Modified</th>
            <th class="align-middle">Action</th>
        </tr>
    </thead>

    <tbody>
        @if (is_object($collections) && $collections->count() > 0)
            @foreach ($collections as $n => $each)
                <tr>
                    <td class="fw-500 text-start">{{ str()->padLeft(++$n, 2, '0') }}</td>
                    <td class="fw-500 text-start">
                        {{ $each?->customer?->name }}
                    </td>
                    <td class="fw-500 text-start">
                        {{ $each?->customer?->mobile }}
                    </td>
                    <td>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center text-body">
                            <div class="flex-fill">
                                <div class="fw-semibold">{{ Str::limit($each?->message, 50, '...') }}</div>
                            </div>
                        </a>
                    </td>

                    <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                    <td class="text-start">
                        @if ($each?->message !== null)
                            <a
                                href="https://wa.me/+88{{ $each?->customer?->mobile }}/?text={{ urlencode($each?->message) }}">WhatsApp</a>
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($each?->call == true)
                            <a
                                href="tel:+88{{ $each?->call_status == false ? $each?->customer?->mobile : '' }}">{{ $each?->call_status == true ? 'Called' : 'Call' }}</a>
                        @else
                            --
                        @endif
                    </td>
                    <td>{{ $each->updated_at->diffForHumans() }}</td>
                    <td>
                        <a class="btn btn-sm btn-success"
                            href="{{ route('admin.vehicle.followup.feedback-message.create', ['followup' => $each?->id]) }}">set
                            feedback</a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Sl</th>
            <th>Customer Name</th>
            <th>Customer Mobile</th>
            <th>Message</th>
            <th>Status</th>
            <th>WhatsApp</th>
            <th>Call</th>
            <th>Modified</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>