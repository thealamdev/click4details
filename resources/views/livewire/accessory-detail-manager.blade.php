<div>

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0">{{ toLocaleString($detail?->translate, $translate) }}<span
                        class="text-danger">({{ toLocaleString($detail->brand?->translate, $translate) }})</span></h3>
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
            <div class="col-12 col-md-7">
                <div class="mb-3">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper mySwiper2 mb-2" onmouseover="pauseAutoplay()" onmouseout="resumeAutoplay()">
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

                <div id="imageModal" class="modal">
                    <span class="close" onclick="closeModal()"><i class="fa-solid fa-xmark"
                            style="font-size: 30px;"></i></span>
                    <img id="modalImage" class="modal-content">
                </div>


            </div>
            <div class="col-12 col-md-5">
                <div class="card rounded border border-slate-200 mb-3">
                    <div class="card-body pb-2">

                        <div class="mb-3">
                            <button class="btn btn-success w-100" wire:click="card('{{ $detail->slug }}')">
                                ADD TO CARD
                            </button>
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



                {{-- <div class="card rounded border border-slate-200 mb-3">
                    <div class="card-body pb-2">
                        <h6 class="text-primary">{{ __('module.detail.heading.details', [], $translate) }}</h6>
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
                </div> --}}

                <!-- Price part !-->
                <div class="card rounded border border-slate-200">
                    <div class="card-body">
                        <h6 class="text-primary">{{ __('module.detail.heading.description', [], $translate) }} </h6>
                        <hr class="my-1 border-1 border-green-600">
                        <p>{!! str()->markdown(toLocaleString($detail?->description, $translate, 'content')) !!}</p>
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
                         {{$suggestions}}
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
    {{-- <script type="text/javascript">
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
    </script> --}}


    <script type="text/javascript">
        var swiper;
        var swiper2;

        document.addEventListener('DOMContentLoaded', function() {
            swiper = new Swiper(".mySwiper", {
                spaceBetween: 10,
                slidesPerView: 7,
                freeMode: true,
                watchSlidesProgress: true,
            });

            swiper2 = new Swiper(".mySwiper2", {
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

            swiper2.on('click', function() {
                var activeSlideIndex = swiper2.clickedIndex;
                openModal(activeSlideIndex);
            });
        });

        function pauseAutoplay() {
            swiper2.autoplay.stop();
        }

        function resumeAutoplay() {
            swiper2.autoplay.start();
        }

        function openModal(slideIndex) {
            var modal = document.getElementById('imageModal');
            var modalImage = document.getElementById('modalImage');
            modalImage.src = swiper2.slides[slideIndex].querySelector('img').src;
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById('imageModal');
            modal.style.display = "none";
        }
    </script>


    <script>
        function toggleMobileNumber(element) {
            const mobileNumberText = element.querySelector("h6");
            const isVisible = mobileNumberText.classList.contains("show-number");

            if (isVisible) {
                mobileNumberText.innerText = "{{ $isMask === true ? $mobile : str($mobile)->mask('X', 7)->toString() }}";
            } else {
                mobileNumberText.innerText = "+88 01407-333777";
            }

            mobileNumberText.classList.toggle("show-number");
        }
    </script>
@endpush
