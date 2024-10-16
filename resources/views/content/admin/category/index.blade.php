@extends('layouts.master')
@section('title', 'Categories')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h4 class="mb-0">Categories</h4>
        <p class="mb-0">Manage all the categories datalist</p>
    </div>
    <div class="dropdown me-1">
        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
            Quick Navigation
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
            <li>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.category.create') }}">
                    Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.category.index') }}">
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
                    <th colspan="2" class="align-middle">Title</th>
                    <th rowspan="2" class="align-middle">Is Feat</th>
                    <th rowspan="2" class="align-middle">Icon</th>
                    <th rowspan="2" class="align-middle">Status</th>
                    <th rowspan="2" class="align-middle">Link</th>
                    <th rowspan="2" class="align-middle">Total</th>
                    <th rowspan="2" class="align-middle">Action</th>
                    <th rowspan="2" class="align-middle">Modified</th>
                </tr>
                <tr>
                    <th>English</th>
                    <th>Bengali</th>
                </tr>
            </thead>
            <tbody>
                @if (is_object($collections) && $collections->count() > 0)
                @foreach ($collections as $n => $each)
                <tr>
                    <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td>
                    <td class="fw-500">{{ toLocaleString($each->translate) }}</td>
                    <td class="fw-500">{{ toLocaleString($each->translate, 'bn') }}</td>
                    <td>{{ str(toFeatureStatus($each->is_feat))->toHtmlString() }}</td>
                    <td class="fw-500"><i class="{{ $each->icon }}"></i></td>
                    <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                    <td class="fw-500">
                        <a href="{{ $each->link ? route($each->link) : 'javascript:;' }}" class="text-decoration-none">Preview</a>
                    </td>
                    <td class="fw-500">{{ $each->merchant_count }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('admin.category.edit', ['category' => $each->id]) }}" class="dropdown-item">Edit</a>
                                <form action="{{ route('admin.category.delete', ['category' => $each->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
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
                    <th>English</th>
                    <th>Bengali</th>
                    <th>Is Feat</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                    <th>Modified</th>
                </tr>
            </tfoot>
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