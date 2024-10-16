@extends('layouts.master')
@section('title', 'Rental Categories')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Rental Categories</h4>
            <p class="mb-0">Manage all the categories datalist</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.rental.category.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.rental.category.index') }}">
                        Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="align-middle">Sl</th>
                        <th class="align-middle">Name</th>
                        <th class="align-middle">Icon</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Link</th>
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
                                <td class="fw-500"><i class="{{ $each->icon }}"></i></td>
                                <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                                <td class="fw-500">
                                    <a href="{{ $each->link ? route($each->link) : 'javascript:;' }}" class="text-decoration-none">Preview</a>
                                </td>
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
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Link</th>
                        <th>Action</th>
                        <th>Modified</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
