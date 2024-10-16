<div class="container my-3">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h3 class="mb-0">{{ toLocaleString($detail?->translate, $translate) }}</h3>
            <p>{{ toLocalElapsed($detail->updated_at->diffForHumans(), $translate) }}</p>
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

            <!-- Rent show part !-->
            <div class="alert alert-success" role="alert">
                <header class="pb-1">
                    <span class="fs-20">Daily Rent (Inside Dhaka)</span>
                </header>
                <div class="border border-slate-100 d-flex p-3 mb-3 rounded align-items-center justify-content-between">
                    <p class="mb-0">Rent : {{ $detail?->daily_charge_inside_dhaka }} tk</p>
                    <p class="mb-0">Visit Limit : {{ $detail?->daily_max_visit_inside }} km</p>
                    <p class="mb-0">Extra Charge Per KM : {{ $detail?->extra_charge_perkm_daily_inside }} tk</p>
                </div>

                <header class="pb-1">
                    <span class="fs-20">Daily Rent (Outside Dhaka)</span>
                </header>
                <div class="border border-slate-100 d-flex p-3 mb-3 rounded align-items-center justify-content-between">
                    <p class="mb-0">Rent : {{ $detail?->daily_charge_outside_dhaka }} tk</p>
                    <p class="mb-0">Visit Limit : {{ $detail?->daily_max_visit_outside }} km</p>
                    <p class="mb-0">Extra Charge Per KM : {{ $detail?->extra_charge_perkm_daily_outside }} tk</p>
                </div>

                <header class="pb-1">
                    <span class="fs-20">Monthly Rent (Inside Dhaka)</span>
                </header>
                <div class="border border-slate-100 d-flex p-3 mb-3 rounded align-items-center justify-content-between">
                    <p class="mb-0">Rent : {{ $detail?->monthly_charge_inside_dhaka }} tk</p>
                    <p class="mb-0">Visit Limit : {{ $detail?->monthly_max_visit_inside }} km</p>
                    <p class="mb-0">Extra Charge Per KM : {{ $detail?->extra_charge_perkm_monthly_inside }} tk</p>
                </div>
                <header class="pb-1">
                    <span class="fs-20">Monthly Rent (Outside Dhaka)</span>
                </header>
                <div class="border border-slate-100 d-flex p-3 mb-3 rounded align-items-center justify-content-between">
                    <p class="mb-0">Rent : {{ $detail?->monthly_charge_outside_dhaka }} tk</p>
                    <p class="mb-0">Visit Limit : {{ $detail?->monthly_max_visit_outside }} km</p>
                    <p class="mb-0">Extra Charge Per KM : {{ $detail?->extra_charge_perkm_monthly_outside }} tk</p>
                </div>
                <div>
                    <p class="m-0 fs-24">{{ __('module.detail.rent', [], $translate) }}</p>
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
                        {{-- <div>{{ __('module.detail.sidebar.seller', [], $translate) }}</div> --}}
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
                                        <p class="m-0 fs-12" style="cursor: pointer">+8801969944400</p>
                                    </h6>
                                </div>
                                {{-- <div>
                                    <h6 class="m-0">
                                        {{ $isMask === true ? $mobile : str($mobile)->mask('X', 7)->toString() }}
                                    </h6>
                                    <p class="m-0 fs-12" style="cursor:pointer;">Click to show mobile number</p>
                                </div> --}}
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
                    <div class="mt-3">
                        {{-- {!! $detail?->video !!} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
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

    {{-- <script>
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
    </script> --}}

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
@endpush
