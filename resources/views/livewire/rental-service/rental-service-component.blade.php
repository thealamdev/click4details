<div class="container my-3">
    <header>
        <h5>@lang('module.shared.rental_service')</h5>
    </header>
    <div class="border border-salte-400 rounded py-5 shadow-sm">
        <div class="row d-flex">
            @foreach ($rental_categories as $each)
                <div class="col-lg-2 px-5 text-center">
                    <a href="{{ route($each?->link) }}" class="card rounded shadow-sm text-decoration-none category-list p-4">
                        <i class="{{ $each?->icon }}"></i>
                        <p class="mb-0 mt-1">{{ $each?->name }}</p>
                        <div class="small text-body text-opacity-50">
                           Total {{ count($rent_cars) }} ads
                        </div>

                    </a>
                </div>
            @endforeach
        </div>
    </div>

     
        <header class="py-3 container">
            <h5>Rental Cars Category</h5>
        </header>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
            @forelse ($rent_cars as $each)
                <div class="col">
                    <div class="card rounded shadow-sm border border-slate-200">
                        <a href="{{ route('home.rental.category.car.detail', ['slug' => $each?->slug]) }}" style="text-decoration: none;color: var(--bs-heading-color);">
                            <div class="card-body p-2">
                                <img src="{{ $each?->image->preview() ?? 'https://placehold.co/600x400' }}" class="card-img-top rounded" loading="lazy" alt="" />
                                <h5 class="fw-500 mt-2 mb-0">
                                    {{ toLocaleString($each?->translate, $translate) }}
                                </h5>

                                <p class="fs-14 d-flex gap-1 mb-0">
                                    <span class="fs-14">
                                        Seat : {{ $each?->seat }}
                                    </span>
                                    <span>|</span>
                                    <span class="fs-14">{{ toLocaleString($each->carmodel->translate, $translate) }}</span>
                                    <span>|</span>
                                    <span class="fs-14">{{ $each?->ac }}</span>
                                </p>

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="card-text">
                                        <h5>Daily Rent : {{ $each?->daily_charge_inside_dhaka }} tk</h5>
                                        <h5>Other in details</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <h5 class="text-center text-danger">No Data Available !!!</h5>
            @endforelse
        </div>
    </div>


 
