<div>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0">{{ toLocaleString($detail?->translate, $translate) }}</h3>
                <p>{{ toLocalElapsed($detail->updated_at->diffForHumans(), $translate) }} - <span class="text-success">{{ $detail?->address }}</span></p>
            </div>
            <div class="btn-group">
                <button id="downloadAllButton" class="btn btn-sm btn-primary"><i class="fa-solid fa-download"></i>
                    Images
                </button>

                <button id="sendToWhatsApp" onclick="sendToWhatsApp('{{ toLocaleString($detail?->translate, $translate) }}','{{ $detail->price }}','{{ $detail->additional_price }}','{{ $detail?->fixed_price }}','{{ toLocaleString($detail?->brand?->translate, $translate) }}','{{ toLocaleString($detail?->edition?->translate, $translate) }}','{{ $detail?->engines }}','{{ toLocaleString($detail?->fuel?->translate, $translate) }}','{{ $detail?->mileages }}','{{ route('home.detail', ['slug' => $detail?->slug]) }}',event)" class="btn btn-sm btn-info"> <i class="fa-brands fa-whatsapp"></i></i>
                    Text
                </button>

                <button id="downloadBtn" class="btn btn-sm btn-success"> <i class="fa-solid fa-file-arrow-down"></i>
                    Document
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-8">
                <div class="mb-3">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 mb-2" onmouseover="pauseAutoplay()" onmouseout="resumeAutoplay()">
                        <div class="swiper-wrapper">
                            @foreach ($detail->gallery as $key => $each)
                                <div class="swiper-slide download-image">
                                    <img src="{{ $each->preview() }}" class="img-fluid rounded-3 object-fit-cover" loading="lazy" style="max-height: 420px; width: 100%;" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($detail->gallery as $key => $each)
                                <div class="swiper-slide">
                                    <img src="{{ $each->preview() }}" class="img-fluid rounded-3" loading="lazy" style="max-height: 112px; width: auto;" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="imageModal" class="modal">
                    <span class="close" onclick="closeModal()"><i class="fa-solid fa-xmark" style="font-size: 30px;"></i></span>
                    <img id="modalImage" class="modal-content">
                </div>

                <!-- Price show part !-->
                <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                    <div>
                        <h3 class="m-0">
                            {{ __('module.detail.price', ['total' => toLocaleNumber($detail->price, $translate)], $translate) }}

                            @if ($detail->unit_price == 'Full Price')
                                {{ __('module.flat.total_price', [], $translate) }}
                            @else
                                {{ __('module.flat.per_sq_ft', [], $translate) }}
                            @endif
                        </h3>

                        @if ($detail->negotiable == 'yes')
                            <p class="m-0 fs-12">{{ __('module.detail.negotiable', [], $translate) }}</p>
                        @else
                            <p class="m-0 fs-12">{{ __('module.detail.fixed', [], $translate) }}</p>
                        @endif
                    </div>
                </div>

                <div id="captureDiv">

                    <div class="card rounded border border-slate-200 mb-3">
                        <div class="card-body pb-2">
                            <h6 class="text-primary">{{ __('module.flat.detail', [], $translate) }}</h6>
                            <hr class="my-1 border-1 border-green-600">
                            <div class="row">

                                <div class="col-12 col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                            <span class="fw-500">
                                                {{ __('module.flat.completion_status', [], $translate) }}
                                                :</span>
                                            <span>{{ toLocaleString($detail?->completionStatus->translate, $translate) }}</span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                            <span class="fw-500">
                                                {{ __('module.flat.furnished_status', [], $translate) }}
                                                :</span>
                                            @if ($detail?->furnishedStatus)
                                                <span>{{ toLocaleString($detail?->furnishedStatus?->translate, $translate) }}</span>
                                            @else
                                                {{ '--' }}
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-12 col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                            <span class="fw-500">
                                                {{ __('module.flat.apartment_complex', [], $translate) }}
                                                :</span>
                                            <span>{{ toLocaleString($detail?->apartmentComplex->translate, $translate) }}</span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                            <span class="fw-500">
                                                {{ __('module.flat.facing', [], $translate) }}
                                                :</span>
                                            <span>{{ $detail?->facing }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                            <span class="fw-500">
                                                {{ __('module.flat.land_share_apartments', [], $translate) }}
                                                :</span>
                                            <span>{{ $detail?->land_share_apartments }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                            <span class="fw-500">
                                                {{ __('module.flat.size', [], $translate) }}
                                                :</span>
                                            <span>{{ toLocaleNumber($detail?->size, $translate) }} {{ __('module.flat.sq_ft', [], $translate) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description part !-->
                <div class="card rounded border border-slate-200 mb-3">
                    <div class="card-body">
                        <h6 class="text-primary">{{ __('module.detail.heading.description', [], $translate) }} </h6>
                        <hr class="my-1 border-1 border-green-600">
                        @if (count($detail->description->pluck('content')) > 0)
                            <p>{!! str()->markdown(toLocaleString($detail->description, $translate, 'content')) !!}</p>
                        @else
                            <p>No Description found !!!</p>
                        @endif
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
                                    <div><a href="tel:+8801969944400"><i class="fa-solid fa-phone fs-18"></i></a>
                                    </div>
                                    <div>
                                        <h6 class="m-0">
                                            {{ $isMask === true ? $mobile : str($mobile)->mask('X', 7)->toString() }}
                                        </h6>
                                        <p class="m-0 fs-12" style="cursor:pointer;">Click to show mobile number</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa-brands fa-whatsapp me-2"></i>Get Whatsapp
                            </button>
                            <button type="button" class="btn btn-warning">
                                <i class="fa-solid fa-reply-all me-2"></i>Send Message
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Suggession part !-->

        {{-- <div class="row">
            <div class="col-lg-12">

                <div class="featured-items">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h4 class="mt-1">{{ __('module.suggestion.suggestion', [], $translate) }}</h4>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
                        @foreach ($suggestions as $item => $each)
                            <div class="col" wire:click="viewCount({{ $each->id }})">
                                <div class="card rounded shadow-sm border border-slate-200">
                                    @if ($each->status !== 1)
                                        <h5 class="text-danger text-center pt-2">SOLD OUT</h5>
                                    @endif
                                    <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}" style="text-decoration: none;color: var(--bs-heading-color)">
                                        <div class="card-body p-2">
                                            <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}" class="card-img-top rounded" loading="lazy" alt="" />
                                            <h5 class="fs-16 fw-500 mt-2 mb-0">
                                                {{ toLocaleString($each?->translate, $translate) }}
                                            </h5>
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

                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>  --}}

        @livewire('elements.modal-element')
    </div>

    @push('script')
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
            function downloadImage(url, fileName) {
                const link = document.createElement('a');
                link.href = url;
                link.download = fileName;
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            function downloadAllImages() {
                var image_name = @json($detail->slug);
                const imageElements = document.querySelectorAll('.download-image img');
                imageElements.forEach((image, index) => {
                    const imageUrl = image.src;
                    const fileName = image_name + `image_${index + 1}.jpg`;
                    downloadImage(imageUrl, fileName);
                });
            }

            const downloadAllButton = document.getElementById('downloadAllButton');
            downloadAllButton.addEventListener('click', downloadAllImages);
        </script>

        <script>
            function toggleMobileNumber(element) {
                const mobileNumberText = element.querySelector("h6");
                const isVisible = mobileNumberText.classList.contains("show-number");

                if (isVisible) {
                    mobileNumberText.innerText = "{{ $isMask === true ? $mobile : str($mobile)->mask('X', 7)->toString() }}";
                } else {
                    mobileNumberText.innerText = "+880196-99-444-00";
                }

                mobileNumberText.classList.toggle("show-number");
            }
        </script>

        <script>
            var iframe = document.querySelector('iframe');
            iframe.style.width = "100%";
            iframe.style.height = "100%";
            iframe.style.borderRadius = "8px";
            iframe.style.maxWidth = "1280px";
        </script>

        <script>
            // Function to capture and download the specified div as an image
            function captureAndDownload() {
                // Specify the div to capture
                var captureDiv = document.getElementById('captureDiv');

                html2canvas(captureDiv).then(function(canvas) {
                    // Convert canvas to image
                    var img = canvas.toDataURL("image/png");
                    // Create a temporary anchor element to download the image
                    var downloadLink = document.createElement("a");
                    downloadLink.href = img;
                    downloadLink.download = "div_image.png";
                    // Trigger the download
                    downloadLink.click();
                });
            }

            // Add event listener to the download button
            document.getElementById("downloadBtn").addEventListener("click", captureAndDownload);
        </script>
        <script>
            function sendToWhatsApp(vehicleName, price, additional_price, fixed_pirce, brand, edition, engines, fuel, mileages,
                details, e) {
                e.preventDefault();
                // console.log(vehicleName, price, brand, edition, engines, fuel, mileages);
                const vehicleNameEncoded = encodeURIComponent("Vehicle Name: " + vehicleName);
                const brandEncoded = encodeURIComponent("Brand: " + brand);
                const editionEncoded = encodeURIComponent("Edition: " + edition);
                const engineEncoded = encodeURIComponent("Engines: " + engines);
                const fuelEncoded = encodeURIComponent("Fuel: " + fuel);
                const mileageEncoded = encodeURIComponent("Mileage: " + mileages);
                const productDetailsEncoded = encodeURIComponent("Click for Details: " + details);
                let finalPrice;

                if (Number(fixed_pirce) > 0) {
                    finalPrice = Number(fixed_pirce) + Number(additional_price);
                } else {
                    finalPrice = Number(price) + Number(additional_price);
                }
                console.log(fixed_pirce, finalPrice)
                const finalPriceEncode = encodeURIComponent('Final Price = ' + finalPrice)
                const whatsappLink =
                    `https://wa.me/?text=${vehicleNameEncoded}%0A${brandEncoded}%0A${editionEncoded}%0A${engineEncoded}%0A${mileageEncoded}%0A${finalPriceEncode}%0A${fuelEncoded}%0A${productDetailsEncoded}`;
                window.open(whatsappLink, "_blank");
            }
        </script>
    @endpush
