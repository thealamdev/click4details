@extends('layouts.master')
@section('title', 'Customer Cares')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Customer Cares</h4>
            <p class="mb-0">Manage all the customer care here...</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('customer-care.register.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="align-middle">Sl</th>
                        <th class="align-middle">Name</th>
                        <th class="align-middle">Email</th>
                        <th class="align-middle">Phone</th>
                        <th class="align-middle text-center">Action</th>
                        <th class="align-middle">Modified</th>
                    </tr>

                </thead>
                <tbody>
                    @if (is_object($customerCare) && $customerCare->count() > 0)
                        @foreach ($customerCare as $n => $each)
                            <tr>
                                <td class="fw-500">{{ str()->padLeft(++$n, 2, '0') }}</td>
                                <td class="fw-500">{{ $each->name }}</td>
                                <td class="fw-500">{{ $each->email }}</td>
                                <td class="fw-500">{{ $each->mobile }}</td>


                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('merchant.customer-care.edit', ['customerCare' => $each->id]) }}"
                                                class="dropdown-item">Edit
                                            </a>
                                            <form
                                                action="{{ route('merchant.customer-care.delete', ['customerCare' => $each->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item">Trash</button>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
            });
        });
    </script>
@endpush
