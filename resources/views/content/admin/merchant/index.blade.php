@extends('layouts.master')
@section('title', 'Merchants')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Merchants</h4>
            <p class="mb-0">Manage all the merchants details</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.merchant.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.merchant.index') }}">
                        Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                        Export Excel<i class="fa-solid fa-file-lines text-body text-opacity-50"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                        Stream PDF<i class="fa-solid fa-bolt text-body text-opacity-50"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                        Download PDF<i class="fa-solid fa-shield-halved text-body text-opacity-50"></i>
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
                        <th class="align-middle">Email Verified</th>
                        <th class="align-middle">Mobile</th>
                        <th class="align-middle">Mobile Verified</th>
                        <th class="align-middle">Code Prefix</th>
                        <th class="align-middle">Merchant Type</th>
                        <th class="align-middle">Action</th>
                        <th class="align-middle">Modified</th>
                    </tr>

                </thead>
                <tbody>
                    @if (is_object($collections) && $collections->count() > 0)
                        @foreach ($collections as $n => $each)
                            <tr>
                                <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td>
                                <td class="fw-500">{{ $each->name }}</td>
                                <td class="fw-500">{{ $each->email }}</td>
                                <td>{{ str(toAccountStatus($each->email_verified_at))->toHtmlString() }}</td>
                                <td class="fw-500">{{ $each->mobile }}</td>
                                <td>{{ str(toAccountStatus($each->mobile_verified_at))->toHtmlString() }}</td>
                                <td class="fw-500">
                                    {{ implode(', ', array_unique($each->code->pluck('prefix')->toArray())) }}
                                </td>
                                <td class="fw-500 {{ $each?->merchant_type == 'partner' ? 'text-danger' : '' }}">
                                    {{ $each?->merchant_type }}
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('admin.merchant.edit', ['merchant' => $each->id]) }}"
                                                class="dropdown-item">Edit</a>
                                            <form action="{{ route('admin.merchant.delete', ['merchant' => $each->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item">Trash</button>
                                            </form>
                                            <a href="{{ route('admin.merchant.show', ['merchant' => $each->id]) }}"
                                                class="dropdown-item">Profile</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $each->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            renderDataTable('#dataTable')
        });
    </script>
@endpush
