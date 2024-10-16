@extends('layouts.master')
@section('title', 'Shipping')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Shipping Datalist</h4>
            <p class="mb-0">Manage all the Shipping Address</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.accessory.shipping.index') }}">
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
                        <th rowspan="2" class="align-middle">Sl</th>
                        <th rowspan="2" class="align-middle">Title</th>
                        <th rowspan="2" class="align-middle">Charge</th>
                        <th rowspan="2" class="align-middle">Url</th>
                        <th rowspan="2" class="align-middle">Actions</th>
                        <th rowspan="2" class="align-middle">Date</th>
                    </tr>

                </thead>
                <tbody>
                    @if (is_object($collections) && $collections->count() > 0)
                        @foreach ($collections as $n => $each)
                            <tr>
                                <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td>
                                <td>
                                    <a href="javascript:;"
                                        class="list-group-item list-group-item-action d-flex align-items-center text-body">
                                        <div class="flex-fill">
                                            <div class="fw-semibold">{{ $each?->name }}</div>
                                        </div>
                                    </a>
                                </td>

                                <td>{{ 'Tk ' . $each?->charge }}</td>

                                <td>
                                    <a href="javascript:;"
                                        class="list-group-item list-group-item-action d-flex align-items-center text-body">
                                        <div class="flex-fill">
                                            {{ $each?->url }}
                                        </div>
                                    </a>
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <div>
                                            <a href="{{ route('admin.accessory.shipping.edit', ['shipping' => $each->id]) }}"
                                                class="dropdown-item"><button class="btn btn-success"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $each->updated_at?->diffForHumans() }}</td>
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
