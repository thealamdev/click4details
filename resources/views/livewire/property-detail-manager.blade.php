<div>

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0">{{ toLocaleString($detail?->translate, $translate) }}</h3>
                <p>{{ toLocalElapsed($detail->updated_at->diffForHumans(), $translate) }}</p>
            </div>
            <div class="btn-group">
                <button class="btn btn-link btn-sm text-decoration-none dropdown-toggle text-slate-600" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-share-nodes me-1"></i>{{ __('module.detail.sidebar.shared', [], $translate) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    @foreach ($shared as $each)
                        <li>
                            <a class="dropdown-item" href="{{ $each->link }}" target="_blank">
                                <i class="{{ $each->icon }} me-2"></i>{{ $each->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="mb-3">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper mySwiper2 mb-2">
                        <div class="swiper-wrapper">
                            @foreach ($detail->gallery as $each)
                                <div class="swiper-slide">
                                    <img src="{{ $each->preview() }}" class="img-fluid rounded-3 object-fit-cover"
                                        loading="lazy" style="max-height: 420px; width: 100%;" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($detail->gallery as $each)
                                <div class="swiper-slide">
                                    <img src="{{ $each->preview() }}" class="img-fluid rounded-3" loading="lazy"
                                        style="max-height: 112px; width: auto;" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Price show part !-->
                <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                    <div>
                        <h3 class="m-0">
                            {{ __('module.detail.price', ['total' => toLocaleNumber(number_format($detail?->price), $translate)], $translate) }}
                        </h3>
                        @if ($detail?->negotiable)
                            <p class="m-0 fs-12">{{ __('module.detail.negotiable', [], $translate) }}</p>
                        @else
                            <p class="m-0 fs-12">{{ __('module.detail.fixed', [], $translate) }}</p>
                        @endif
                    </div>
                    <div>
                        <h3>Code</h3>
                        <p>
                            @if ($detail?->code)
                                {{ $detail?->code }}
                            @else
                                {{ '--' }}
                            @endif

                        </p>
                    </div>
                </div>

                <div class="card rounded border border-slate-200 mb-3">
                    <div class="card-body pb-2">
                        <h6 class="text-primary">{{ __('module.detail.heading.features', [], $translate) }}</h6>
                        <hr class="my-1 border-1 border-green-600">
                        <div class="row">

                            <div class="col-12 col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                        <span class="fw-500">{{ __('module.land.land-type', [], $translate) }}
                                            :</span>
                                        <span>{{ toLocaleString($detail?->type?->translate, $translate) }}</span>
                                    </li>

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                        <span class="fw-500">{{ __('module.land.land-size', [], $translate) }}
                                            :</span>
                                        @if ($detail?->priceunit)
                                            <span>{{ $detail?->land_size }}
                                                {{ toLocaleString($detail?->sizeunit?->translate, $translate) }}</span>
                                        @else
                                            {{ '--' }}
                                        @endif
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Price part !-->
                <div class="card rounded border border-slate-200">
                    <div class="card-body">
                        <h6 class="text-primary">{{ __('module.detail.heading.description', [], $translate) }} </h6>
                        <hr class="my-1 border-1 border-green-600">
                        <p>{!! str()->markdown(toLocaleString($detail?->description, $translate, 'content')) !!}</p>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-4">
                <div class="card rounded border border-slate-200 mb-3">
                    <div class="card-body pb-2">
                        <div class="mb-3">
                            <div>{{ __('module.detail.sidebar.seller', [], $translate) }}</div>
                            <hr class="my-1 border-1 border-green-600">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="m-0">Pilot Bazar Limited</h5>
                                    <p class="m-0 fs-12">Member since 2023</p>
                                </div>
                                <div class="text-success">
                                    <i class="fa-solid fa-certificate me-1"></i>Verified
                                </div>
                            </div>
                        </div>


                        <div class="mb-3" onclick="toggleMobileNumber(this)">
                            <div class="card card-body">
                                <div class="d-flex gap-3 align-items-center">
                                    <div><i class="fa-solid fa-phone fs-18"></i></div>
                                    <div>
                                        <h6 class="m-0">
                                            {{ $isMask === true? $mobile: str($mobile)->mask('X', 7)->toString() }}
                                        </h6>
                                        <p class="m-0 fs-12" style="cursor:pointer;">Click to show mobile number</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-grid gap-2 mb-3">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="fa-brands fa-whatsapp me-2"></i>Get Whatsapp
                            </button>
                            <button type="button" class="btn btn-warning">
                                <i class="fa-solid fa-reply-all me-2"></i>Send Message
                            </button>
                        </div>
                        <div class="mt-3">
                            <iframe class="filter dark:grayscale" width="100%" height="100%"
                                style="border-radius: 8px; max-width: 1280px" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=Pilot+Bazar+Ltd.,+Dhaka&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                             
                        </div>
                    </div>
                </div>
                <div class="card rounded border border-slate-200">
                    <div class="card-body">
                        <div class="mb-5">
                            <h6 class="text-primary">{{ __('module.detail.sidebar.add_price', [], $translate) }}</h6>
                            <div>
                                <div class="form-floating mb-2">
                                    <input type="tel" class="form-control" name="mobile" value="880 1" />
                                    <label
                                        for="mobile">{{ __('module.detail.sidebar.mobile', [], $translate) }}</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="number" step="any" min="100000" class="form-control"
                                        name="price" placeholder="Enter Price" />
                                    <label
                                        for="price">{{ __('module.detail.sidebar.amount', [], $translate) }}</label>
                                </div>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary">
                                        <i
                                            class="fa-solid fa-plus me-1"></i>{{ __('module.detail.sidebar.confirm', [], $translate) }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-primary"> {{ __('module.detail.sidebar.bidding', [], $translate) }}</h6>
                            <div class="list-group list-group-flush">
                                @foreach (range(1, 5) as $each)
                                    <a href="javascript:;"
                                        class="list-group-item list-group-item-action px-2 rounded pb-1"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-0 fs-14">
                                                {{ __('module.detail.price', ['total' => toLocaleNumber(number_format(rand(10000000, 12145435)), $translate)], $translate) }}
                                            </h6>
                                            <small>{{ toLocalElapsed('1 day ago', $translate) }}</small>
                                        </div>
                                        <p class="m-0 fs-12 text-gray-400">
                                            {{ sprintf('+880 17%s XXXXXX', rand(11, 99)) }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--  suggesstions start --}}
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="featured-items">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h4 class="mt-1">{{ __('module.suggestion.suggestion', [], $translate) }}</h4>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
                        @foreach ($suggestions as $item => $each)
        
                        <div class="col">
        
                            <div class="card rounded shadow-sm border border-slate-200">
                                <a  href="{{ route('home.detail', ['slug' => $each?->slug]) }}" style="text-decoration: none;color: var(--bs-heading-color)">
                                    <div class="card-body p-2">
                                        <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}" class="card-img-top rounded" loading="lazy" alt="" />
                                        <h5 class="fs-16 fw-500 mt-2 mb-0">{{ toLocaleString($each?->translate, $translate) }}
                                        </h5>
                                        <p class="fs-12 d-flex gap-1">
                                            <span>
                                                @if ($each->registration)
                                                <i class="fa-solid fa-registered me-1"></i>{{ toLocaleNumber($each->registration, $translate) }}
                                                @endif
                                            </span>
                                            <span>|</span>
                                            <span><i class="fa-solid fa-shield-halved me-1"></i>{{ toLocaleString($each->grade?->translate, $translate) }}</span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="card-text">
                                                <p class="m-0"><small>{{ __('module.datalist.price', [], $translate) }}
                                                        ({{ __('module.datalist.BDT', [], $translate) }})</small></p>
                                                @if (!empty($each->price))
                                                <h4 class="fs-18 fw-600 m-0">{{ __('module.datalist.TK', [], $translate) }}
                                                    {{ toLocaleNumber(number_format($each?->price), $translate) }}
                                                </h4>
                                                @else
                                                <p class="m-0 fs-12">{{ __('module.datalist.footnote', [], $translate) }}
                                                </p>
                                                @endif
        
        
                                            </div>
                                            <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}" class="btn btn-link btn-sm text-decoration-none align-self-end fw-500">
                                                {{ __('module.datalist.preview', [], $translate) }}<i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
        
                        </div>
        
                        @endforeach
                    </div>
        
                     
                    
                </div>
            </div>
        </div> --}}
        {{--  suggesstions start end --}}



    </div>
    @livewire('elements.modal-element')
</div>

@push('script')
    <script type="text/javascript">
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 7,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>

    <script>
        function toggleMobileNumber(element) {
            const mobileNumberText = element.querySelector("h6");
            const isVisible = mobileNumberText.classList.contains("show-number");

            if (isVisible) {
                mobileNumberText.innerText = "{{ $isMask === true? $mobile: str($mobile)->mask('X', 7)->toString() }}";
            } else {
                mobileNumberText.innerText = "+88 01407-333777";
            }

            mobileNumberText.classList.toggle("show-number");
        }
    </script>

   
@endpush
