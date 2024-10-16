@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">FollowUp Message List</h4>
            <p class="mb-0">Manage all the followUp message</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.customer-care.followup-message.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.customer-care.followup-message.index') }}">
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
            @include('content.package.customer-care.set-followup.partials.table')
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
