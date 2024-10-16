@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded border border-gray-300 mb-2">
                    <div class="card-body">
                        <form action="{{ route('admin.vehicle.product.secure') }}" method="GET">
                            <div class="row">

                                <div class="col-lg-2">
                                    <input type="text" name="vehicles_name" value="{{ request()->vehicles_name }}"
                                        placeholder="Search by Name" class="form-control">
                                </div>

                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="code"
                                        placeholder="Seach by Vehicles Code" class="form-control"
                                        value="{{ request()->code }}">
                                </div>


                                <div class="col-lg-2">
                                    <select name="status" class="form-control">
                                        <option value="">-- Select Vehicles Status --</option>
                                        <option value="2" {{ request()->status == '2' ? 'selected' : '' }}>
                                            Pending
                                        </option>

                                        <option value="1" {{ request()->status === '1' ? 'selected' : '' }}>
                                            Approved
                                        </option>
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ request()->start_date }}">
                                </div>

                                <div class="col-lg-2">
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ request()->end_date }}">
                                </div>

                                <div class="col-lg-2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button class="btn btn-success w-100">Search</button>
                                        </div>

                                        <div class="col-lg-6">
                                            <a href="{{ route('admin.vehicle.product.secure') }}"><button type="button"
                                                    class="btn btn-danger w-100">Reset</button>
                                            </a>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-2 g-lg-3 mb-4">
                @if (count($vehicles) > 0)
                    @foreach ($vehicles as $each)
                        <div class="col">
                            <div class="card rounded shadow-sm border border-slate-200">
                                <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}"
                                    style="text-decoration: none;color: var(--bs-heading-color)">
                                    <div class="card-body p-2">
                                        <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                            class="card-img-top rounded" loading="lazy" alt="" />
                                        <h5 class="fs-16 fw-500 mt-2 mb-0">{{ toLocaleString($each?->translate) }}
                                            <div class="text-blue-600 fs-12 fw-500">
                                                {{ sprintf('@%s', $each?->merchant?->name) }}
                                            </div>
                                        </h5>
                                        <p class="fs-12 d-flex gap-1">
                                            <span><i
                                                    class="fa-solid fa-registered me-1"></i>{{ toLocaleNumber($each->registration) }}</span>
                                            <span>|</span>
                                            <span><i
                                                    class="fa-solid fa-shield-halved me-1"></i>{{ toLocaleString($each->grade?->translate) }}</span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="card-text">
                                                <p class="m-0"><small>{{ __('module.datalist.price', []) }}
                                                        ({{ __('module.datalist.BDT', []) }})
                                                    </small></p>
                                                <h4 class="fs-18 fw-600 m-0">{{ __('module.datalist.TK', []) }}
                                                    {{ toLocaleNumber(number_format($each?->price)) }}</h4>
                                            </div>
                                            <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}"
                                                class="btn btn-link btn-sm text-decoration-none align-self-end fw-500">
                                                {{ __('module.datalist.preview') }}<i
                                                    class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>No Data Found !!!</h2>
                @endif

            </div>
        </div>
    </div>
@endsection
