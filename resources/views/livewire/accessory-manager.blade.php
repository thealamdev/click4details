<div class="container mb-5">
    <div class="row">
        <div class="col-12 col-md-3">
            <form wire:submit.prevent="filterVehiclesData">
                <div class="card rounded border border-slate-200">
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-primary">{{ __('module.product.sort.title', [], $translate) }}</h6>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="price" class="form-select" id="floatingPriceSelect"
                                    aria-label="Floating label select example">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}</option>
                                    <option value="1">{{ __('module.product.sort.htl', [], $translate) }}</option>
                                    <option value="2">{{ __('module.product.sort.lth', [], $translate) }}</option>
                                </select>
                                <label
                                    for="floatingPriceSelect">{{ __('module.product.price.title', [], $translate) }}</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="order" class="form-select" id="floatingOrderSelect"
                                    aria-label="Floating label select example">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}</option>
                                    <option value="1">{{ __('module.product.order.asc', [], $translate) }}</option>
                                    <option value="2">{{ __('module.product.order.desc', [], $translate) }}
                                    </option>
                                </select>
                                <label
                                    for="floatingOrderSelect">{{ __('module.product.order.title', [], $translate) }}</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-primary">{{ __('Search', [], $translate) }}</h6>
                            <div class="form-floating mb-2">
                                <input wire:model.defer="searchTerm" type="text" class="form-control"
                                    id="floatingSearch" placeholder="Search...">
                                <label for="floatingSearch">{{ __('Search Term', [], $translate) }}</label>
                            </div>
                        </div>


                        <div class="mb-3">
                            <h6 class="text-primary">{{ __('module.product.location', [], $translate) }}</h6>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <input class="form-check-input me-1" type="checkbox" value=""
                                        id="firstCheckboxStretched">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-500">Gulshan</div>
                                        <div class="fs-12">Total {{ rand(1, 210) }} Cars found</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-warning w-100">
                                <i class="fa-solid fa-eraser me-1"></i>{{ __('module.product.reset', [], $translate) }}
                            </button>
                            <button type="submit" class="btn btn-outline-success w-100">
                                <i
                                    class="fa-solid fa-recycle me-1"></i>{{ __('module.product.filter', [], $translate) }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-12 col-md-9">

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-2 g-lg-3 mb-4">
                @foreach ($accessory as $each)
                    @if ($each?->quantity > 0)
                        <div class="col">
                            <div class="card rounded shadow-sm border border-slate-200">
                                @if ($each?->status !== 1)
                                <h5 class="text-danger text-center pt-2">Not Available</h5>
                                @endif
                                
                                <a href="{{ route('home.accessory-detail', ['slug' => $each?->slug]) }}"
                                    style="text-decoration: none;color: var(--bs-heading-color)">
                                    <div class="card-body p-2">
                                        <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                            class="card-img-top rounded" loading="lazy" alt="" />
                                        <h5 class="fs-16 fw-500 mt-2 mb-0">
                                            {{ toLocaleString($each?->translate, $translate) }}</h5>
                                        <p class="fs-12 d-flex gap-1">
                                            <span>Brand : </i>
                                                {{ toLocaleString($each->brand?->translate, $translate) }}
                                                <span>
                                                </span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="card-text">

                                                <h4 class="fs-18 fw-600 m-0">
                                                    {{ __('module.datalist.TK', [], $translate) }}
                                                    {{ toLocaleNumber(number_format($each?->price), $translate) }}
                                                </h4>

                                            </div>
                                            <a href="{{ route('home.accessory-detail', ['slug' => $each?->slug]) }}"
                                                class="btn btn-link btn-sm text-decoration-none align-self-end fw-500">
                                                {{ __('module.datalist.preview', [], $translate) }}<i
                                                    class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</div>
