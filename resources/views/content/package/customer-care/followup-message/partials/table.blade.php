<table id="dataTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th class="align-middle">Sl</th>
            <th class="align-middle">Stage</th>
            <th class="align-middle">Message</th>
            <th class="align-middle">Status</th>
            <th class="align-middle">Action</th>
            <th class="align-middle">Modified</th>
        </tr>
    </thead>

    <tbody>
        @if (is_object($collections) && $collections->count() > 0)
            @foreach ($collections as $n => $each)
                <tr>
                    <td class="fw-500 text-start">{{ str()->padLeft(++$n, 2, '0') }}</td>
                    <td class="fw-500 text-center" style="width: 130px !important">
                        <p class="px-2 py-1 rounded text-white {{ !empty($each?->stage) ? 'bg-green-700' : '' }}">
                            {{ $each?->stage }}
                        </p>
                    </td>
                    <td>
                        <div class="flex-fill">
                            <div class="fw-semibold">{{ $each?->message }}</div>
                        </div>
                    </td>

                    <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                    <td class="text-start">
                        <div class="dropdown">
                            <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('admin.customer-care.followup-message.edit', ['followupMessage' => $each->id]) }}"
                                    class="dropdown-item text-danger">Edit</a>
                                <form
                                    action="{{ route('admin.customer-care.followup-message.delete', ['followupMessage' => $each->id]) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Trash</button>
                                </form>

                            </div>
                        </div>
                    </td>
                    <td>{{ $each->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Sl</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
            <th>Modified</th>
        </tr>
    </tfoot>
</table>
