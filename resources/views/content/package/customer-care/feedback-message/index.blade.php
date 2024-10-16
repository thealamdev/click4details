@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Feedback Message List</h4>
            <p class="mb-0">Manage all the feedback message</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.customer-care.feedback-message.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.customer-care.feedback-message.index') }}">
                        Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

            </ul>
        </div>
    </div>

    <div class="card rounded border border-gray-300">
        <div class="card-body" style="overflow: auto">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="align-middle">Sl</th>
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
                                <td>
                                    <a href="#"
                                        class="list-group-item list-group-item-action d-flex align-items-center text-body">
                                        <div class="flex-fill">
                                            <div class="fw-semibold">{{ $each?->message }}</div>
                                        </div>
                                    </a>
                                </td>

                                <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                                <td class="text-start">
                                    <div class="dropdown">
                                        <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('admin.customer-care.feedback-message.edit', ['feedbackMessage' => $each->id]) }}"
                                                class="dropdown-item text-danger">Edit</a>
                                            <form
                                                action="{{ route('admin.customer-care.feedback-message.delete', ['feedbackMessage' => $each->id]) }}"
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

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [20, 40, 60, 100, -1],
                    [20, 40, 60, 100, "All"]
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
