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
                            <h6 class="text-primary">{{ __('module.product.category', [], $translate) }}</h6>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="brand" class="form-select" id="floatingBrandSelect"
                                    aria-label="Brand label select">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}
                                    </option>
                                    @foreach ($brands as $each)
                                        <option value="{{ $each->id }}" :wire:key="$each->id">
                                            {{ toLocaleString($each?->translate, $translate) }}</option>
                                    @endforeach
                                </select>
                                <label
                                    for="floatingBrandSelect">{{ __('module.product.brand', [], $translate) }}</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="condition" class="form-select" id="floatingConditionSelect"
                                    aria-label="Condition label select">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}
                                    </option>
                                    @foreach ($conditions as $each)
                                        <option value="{{ $each->id }}" :wire:key="$each->id">
                                            {{ toLocaleString($each?->translate, $translate) }}</option>
                                    @endforeach
                                </select>
                                <label
                                    for="floatingConditionSelect">{{ __('module.product.condition', [], $translate) }}</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="mileage" class="form-select" id="floatingMileageSelect"
                                    aria-label="Mileage label select">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}
                                    </option>
                                    @foreach ($mileages as $each)
                                        <option value="{{ $each->id }}" :wire:key="$each->id">
                                            {{ toLocaleString($each?->translate, $translate) }}</option>
                                    @endforeach
                                </select>
                                <label
                                    for="floatingMileageSelect">{{ __('module.product.mileage', [], $translate) }}</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="skeleton" class="form-select" id="floatingSkeletonSelect"
                                    aria-label="Skeleton label select">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}
                                    </option>
                                    @foreach ($skeletons as $each)
                                        <option value="{{ $each->id }}" :wire:key="$each->id">
                                            {{ toLocaleString($each?->translate, $translate) }}</option>
                                    @endforeach
                                </select>
                                <label
                                    for="floatingSkeletonSelect">{{ __('module.product.skeleton', [], $translate) }}</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select wire:model.defer="skeleton" class="form-select" id="floatingTransmissionSelect"
                                    aria-label="Transmission label select">
                                    <option selected disabled>{{ __('module.product.select', [], $translate) }}
                                    </option>
                                    @foreach ($transmissions as $each)
                                        <option value="{{ $each->id }}" :wire:key="$each->id">
                                            {{ toLocaleString($each?->translate, $translate) }}</option>
                                    @endforeach
                                </select>
                                <label
                                    for="floatingTransmissionSelect">{{ __('module.product.transmission', [], $translate) }}</label>
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
                {{-- <div class="card rounded border border-slate-200 mt-4">
                    <div class="card-body">
                        <h6 class="fs-20 fw-500 text-gray-600">{{ __('module.product.popular', [], $translate) }}</h6>
                        <div class="row row-cols-3 row-cols-md-3 row-cols-lg-3 g-2">
                            @foreach ($brands as $item => $each)
                            <div class="col">
                                <div class="card rounded shadow-sm border border-slate-100 p-3">
                                    <img src="{{ $each?->image?->preview() ?? asset('assets/img/brand/brand-'. $item + 1 .'.png') }}" class="img-fluid object-fit-fill rounded mx-auto d-block border-0" alt="..." style="height: 48px; width: 48px;" />
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
            </form>
        </div>
        <div class="col-12 col-md-9">

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-2 g-lg-3 mb-4">
                @foreach ($vehicles as $each)
                    <div class="col" wire:click="viewCount({{ $each->id }})">
                        <div class="card rounded shadow-sm border border-slate-200">
                            <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}"
                                style="text-decoration: none;color: var(--bs-heading-color)">
                                <div class="card-body p-2">
                                    <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                        class="card-img-top rounded" loading="lazy" alt="" />
                                    <h5 class="fs-16 fw-500 mt-2 mb-0">
                                        {{ toLocaleString($each?->translate, $translate) }}</h5>

                                    <p class="fs-12 d-flex gap-1">
                                        <span>
                                            @if ($each->registration)
                                                <i class="fa-solid fa-registered me-1"></i>
                                                {{ toLocaleNumber($each->registration, $translate) }}
                                            @else
                                                <span><i class="fa-solid fa-shield-halved me-1"></i>
                                                    {{ toLocaleString($each->grade?->translate, $translate) }}</span>
                                            @endif
                                        </span>
                                        <span>|</span>
                                        <span>{{ toLocaleString($each->condition?->translate, $translate) }}</span>
                                        <span>|</span>
                                        @if (!empty($each?->mileages))
                                            <span>
                                                <i class="fa-solid fa-mill-sign"></i>
                                                {{ toLocaleNumber($each->mileages, $translate) }}
                                            </span>
                                        @else
                                            <span>
                                                <i class="fa-solid fa-mill-sign"></i>
                                                {{ toLocaleString($each->mileage?->translate, $translate) }}
                                            </span>
                                        @endif

                                    </p>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="card-text">
                                            <p class="m-0">
                                                <small>
                                                    {{ toLocaleString($each?->available?->translate, $translate) }}
                                                </small>
                                            </p>
                                            <p class="m-0">
                                                <small>
                                                    {{ 'Code : ' . $each?->code }}
                                                </small>
                                            </p>
                                            @if ($each?->fixed_price > 0)
                                                <h4 class="fs-18 fw-600 m-0">
                                                    {{ __('module.datalist.TK', [], $translate) }}
                                                    @if ($each?->fixed_price > 0)
                                                        {{ number_format(($each?->fixed_price ?? 0) + ($each?->additional_price ?? 0)) }}
                                                    @endif
                                                </h4>
                                            @else
                                                <h4 class="fs-18 fw-600 m-0">
                                                    {{ __('module.datalist.TK', [], $translate) }}
                                                    {{ $each?->price }}
                                                </h4>
                                            @endif


                                        </div>
                                        {{-- <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}"
                                            class="btn btn-link btn-sm text-decoration-none align-self-end fw-500">
                                            {{ __('module.datalist.preview', [], $translate) }}<i
                                                class="fa-solid fa-arrow-right ms-1"></i>
                                        </a> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
