@extends('layouts.master')
@section('title', 'Accessory Brands')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Accessory Brands</h4>
            <p class="mb-0">Manage all the accessory brands</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.accessory.brand.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.accessory.brand.index') }}">
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
                        <th rowspan="2" class="align-middle">Description</th>
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
                                            <div class="fw-semibold">{{ toLocaleString($each?->translate) }}</div>
                                        </div>
                                    </a>
                                </td>
                                <td class="fw-500">{!! $each?->description!!}</td>
                                
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('admin.accessory.brand.edit', ['brand' => $each->id]) }}"
                                                class="dropdown-item">Edit</a>
                                            <form
                                                action="{{ route('admin.accessory.brand.delete', ['brand' => $each->id]) }}"
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

            </table>
            {{-- {{ $accessory->links() }} --}}
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthMenu": [ [20, 40, 60, 100, -1], [20, 40, 60, 100, "All"] ]
            });
        });
    </script>
@endpush
