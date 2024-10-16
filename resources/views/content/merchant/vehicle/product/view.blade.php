@extends('layouts.public')
@section('title', $product->merchant?->merchantInfo?->company_name)
@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{ $product?->merchant->merchantInfo->website ?? '#' }}">
                <img src="{{ asset('storage/merchants/' . $product?->merchant->merchantInfo?->image?->name) }}"
                    alt="{{ asset('storage/merchants/' . $product?->merchant->merchantInfo?->image?->name) }}" width="110px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active">
                            {{ $product?->merchant?->merchantInfo?->company_name }} <br>
                            {!! $product?->merchant?->merchantInfo?->address !!}
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="mb-3">
                        <button id="downloadAllButton" class="btn btn-primary mt-3"><i class="fa-solid fa-download"></i>
                            Images</button>
                        <button id="downloadBtn" class="btn btn-success mt-3"><i class="fa-solid fa-download"></i>
                            Documents</button>
                    </div>
                    <div class="warning">
                        <p class="text-success">Use Google Chrome For Better Experience</p>
                    </div>

                    <div class="mb-3">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="swiper mySwiper2 mb-2" onmouseover="pauseAutoplay()" onmouseout="resumeAutoplay()">
                            <div class="swiper-wrapper">
                                @foreach ($product->gallery as $key => $each)
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
                                @foreach ($product->gallery as $key => $each)
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

                    <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                        <div>
                            <h3 class="m-0">
                                {{ number_format($product?->price, 2) }} Tk
                            </h3>
                        </div>
                    </div>

                    <div id="captureDiv">
                        <div class="card rounded border border-slate-200 mb-3">
                            <div class="card-body pb-2">
                                <h6 class="text-primary">Features</h6>
                                <hr class="my-1 border-1 border-green-600">
                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Brand
                                                    :</span>
                                                <span>{{ toLocaleString($product?->brand->translate) }}</span>
                                            </li>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500"> Model
                                                    :</span>
                                                @if ($product?->carmodel)
                                                    <span>{{ toLocaleString($product?->carmodel?->translate) }}</span>
                                                @else
                                                    {{ '--' }}
                                                @endif
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Edition
                                                    :</span>
                                                <span>
                                                    @if ($product?->edition)
                                                        {{ toLocaleString($product?->edition?->translate) }}
                                                    @else
                                                        {{ '--' }}
                                                    @endif
                                                </span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Manufacture
                                                    :</span>
                                                <span>{{ toLocaleNumber(number_format($product?->manufacture)) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Engine
                                                    :
                                                </span>
                                                @if (!empty($product?->engine))
                                                    <span>{{ toLocaleString($product?->engine?->translate) }}</span>
                                                @else
                                                    <span>{{ $product?->engines }}</span>
                                                @endif

                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Condition
                                                    :</span>
                                                <span>{{ toLocaleString($product?->condition?->translate) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Fuel
                                                    :</span>
                                                <span>{{ toLocaleString($product?->fuel?->translate) }}</span>
                                            </li>

                                            </li>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Skeletion
                                                    :</span>
                                                <span>{{ toLocaleString($product?->skeleton?->translate) }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Mileage
                                                    :</span>
                                                @if (!empty($product?->mileage))
                                                    <span>{{ toLocaleString($product?->mileage?->translate) }}</span>
                                                @else
                                                    <span>{{ $product?->mileages }}</span>
                                                @endif

                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Transmission
                                                    :</span>
                                                <span>{{ toLocaleString($product?->transmission->translate) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Registration
                                                    :</span>
                                                <span>
                                                    @if ($product?->registration)
                                                        {{ toLocaleNumber(number_format($product?->registration)) }}
                                                    @else
                                                        {{ '--' }}
                                                    @endif
                                                </span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Grade
                                                    :</span>
                                                <span>
                                                    @if ($product->grade)
                                                        {{ toLocaleString($product->grade?->translate) }}
                                                    @else
                                                        {{ '--' }}
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-0 pb-1 border-0">
                                                <span class="fw-500">Color
                                                    :</span>
                                                @if ($product?->color)
                                                    <span>{{ toLocaleString($product?->color?->translate) }}</span>
                                                @else
                                                    {{ '--' }}
                                                @endif
                                            </li>

                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Featres part !-->
                        <div class="card rounded border border-slate-200 mb-3">
                            <div class="card-body pb-2">
                                <div class="row">
                                    <h6 class="text-primary">
                                        Specific Features: </h6>
                                    <hr class="my-1 border-1 border-green-600">
                                    @php
                                        $uniqueFeatures = [];
                                    @endphp

                                    @foreach ($product->vehicle_feature as $f)
                                        @php
                                            $featureTitle = $f->feature?->title;
                                            $featureId = $f->feature?->id;
                                        @endphp

                                        @if (!in_array($featureTitle, $uniqueFeatures))
                                            <div class="col-lg-4 col-md-4 px-4">
                                                <h6 class="text-primary mt-3">
                                                    {{ $featureTitle }}</h6>
                                                <hr class="my-1 border-1 border-green-600">

                                                @php
                                                    $uniqueFeatures[] = $featureTitle;
                                                @endphp

                                                <span>
                                                    @foreach ($product->vehicle_feature as $productFeature)
                                                        @if ($productFeature->feature?->title === $featureTitle)
                                                            {{-- <i class="fa-solid fa-chevron-right"></i> --}}
                                                            <span
                                                                class="ps-2">{{ $productFeature->detail?->title }}</span>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-md-4">
                    <div class="card rounded border border-slate-200 mb-3">
                        <div class="card-body pb-2">
                            <div class="mb-3">
                                <div>Seller Information</div>
                                <hr class="my-1 border-1 border-green-600">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="m-0">{{ $product->merchant?->merchantInfo?->company_name }}</h5>
                                        <p class="m-0 fs-12">Member since
                                            {{ date_format($product->merchant?->created_at, 'Y') }}
                                        </p>
                                    </div>
                                    <div class="text-success">
                                        <i class="fa-solid fa-certificate me-1"></i>Verified
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <span class="d-block"><i class="fa-solid fa-globe text-primary"></i>
                                        <a class="text-primary fs-6"
                                            href="{{ $product->merchant?->merchantInfo?->website ?? '#' }}">Website</a>
                                    </span>
                                    <span class="d-block">
                                        <i class="fa-brands fa-facebook text-primary"></i>
                                        <a class="text-primary fs-6"
                                            href="{{ $product->merchant?->merchantInfo?->facebook ?? '#' }}">Facebook</a>
                                    </span>
                                    <span><i class="fa-brands fa-youtube text-danger"></i>
                                        <a class="text-primary fs-6"
                                            href="{{ $product->merchant?->merchantInfo?->youtube ?? '#' }}">Youtube</a>
                                    </span>

                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="card card-body">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div><a href="tel:+8801969944000"><i class="fa-solid fa-phone fs-18"></i></a>
                                        </div>
                                        <div>
                                            <h6 class="m-0">
                                                {{ $product->merchant?->mobile }}
                                            </h6>
                                            <p class="m-0 fs-12" style="cursor:pointer;">Call For More Info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                @if ($product->merchant?->id == 1)
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#whatsAppModal">
                                        Get Whatsapp
                                    </button>
                                @else
                                    <div class="d-grid gap-2 mb-3">
                                        <a class="btn btn-success"
                                            href="https://wa.me/{{ $product->merchant?->mobile }}"><i
                                                class="fa-brands fa-whatsapp me-2"></i>Get Whatsapp
                                        </a>
                                    </div>
                                @endif

                                <div class="modal fade" id="whatsAppModal" tabindex="-1"
                                    aria-labelledby="whatsAppModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="whatsAppModalLabel">WhatsApp</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <a href="https://wa.me/+8801407054422"
                                                                    class="text-secondary fs-5 text-decoration-none"><i
                                                                        class="fa-brands fa-whatsapp me-2"></i>+8801407054422
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mb-2">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <a href="https://wa.me/+8801407054411"
                                                                    class="text-secondary fs-5 text-decoration-none"><i
                                                                        class="fa-brands fa-whatsapp me-2"></i>+8801407054411
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <a href="https://wa.me/+8801407054400"
                                                                    class="text-secondary fs-5 text-decoration-none"><i
                                                                        class="fa-brands fa-whatsapp me-2"></i>+8801407054400
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <a href="https://wa.me/+8801407054404"
                                                                    class="text-secondary fs-5 text-decoration-none"><i
                                                                        class="fa-brands fa-whatsapp me-2"></i>+8801407054404
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-3">
                                {!! $product?->video !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- suggession part start !-->
            <div class="row">
                <div class="col-lg-12">

                    <div class="featured-items">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="mt-1">Suggessions</h4>
                        </div>

                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
                            @foreach ($suggestions as $item => $each)
                                <div class="col" wire:click="viewCount({{ $each->id }})">
                                    <div class="card rounded shadow-sm border border-slate-200">
                                        @if ($each->status !== 1)
                                            <h5 class="text-danger text-center pt-2">SOLD OUT</h5>
                                        @endif
                                        <a href="{{ route('merchant.view', ['product' => $each?->slug]) }}"
                                            style="text-decoration: none;color: var(--bs-heading-color)">
                                            <div class="card-body p-2">
                                                <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                                    class="card-img-top rounded" loading="lazy" alt="" />
                                                <h5 class="fs-16 fw-500 mt-2 mb-0">
                                                    {{ $each?->translate[0]->title }}
                                                </h5>
                                                <p class="fs-12 d-flex gap-1">
                                                    <span>
                                                        @if ($each->registration)
                                                            <i class="fa-solid fa-registered me-1"></i>
                                                            {{ toLocaleNumber($each->registration) }}
                                                        @else
                                                            <span><i class="fa-solid fa-shield-halved me-1"></i>
                                                                {{ $each->grade?->translate[0]->title }}</span>
                                                        @endif
                                                    </span>
                                                    <span>|</span>
                                                    <span>{{ $each->condition?->translate[0]->title }}</span>
                                                    <span>|</span>

                                                    @if (!empty($each?->mileages))
                                                        <span>
                                                            <i class="fa-solid fa-mill-sign"></i>
                                                            {{ toLocaleNumber($each->mileages) }}
                                                        </span>
                                                    @else
                                                        <span>
                                                            <i class="fa-solid fa-mill-sign"></i>
                                                            {{ $each->mileage?->translate[0]->title }}
                                                        </span>
                                                    @endif
                                                </p>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="card-text">
                                                        <p class="m-0">
                                                            <small>
                                                                {{ $each?->available?->translate[0]->title }}
                                                            </small>
                                                        </p>

                                                        @if ($each?->fixed_price > 0)
                                                            <h4 class="fs-18 fw-600 m-0">
                                                                {{ 'Tk' }}
                                                                @if ($each?->fixed_price > 0)
                                                                    {{ number_format(($each?->fixed_price ?? 0) + ($each?->additional_price ?? 0)) }}
                                                                @endif
                                                            </h4>
                                                        @else
                                                            <h4 class="fs-18 fw-600 m-0">
                                                                {{ 'Tk' }}
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
            </div>
            <!-- suggession part end !-->
        </div>
    </main>
@endsection

@push('js')
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
            var image_name = @json($product->slug);
            const imageElements = document.querySelectorAll('.swiper-slide img');
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
        var iframe = document.querySelector('iframe');
        iframe.style.width = "100%";
        iframe.style.height = "100%";
        iframe.style.borderRadius = "8px";
        iframe.style.maxWidth = "1280px";
    </script>

    <script>
        function captureAndDownload() {
            var image_name = @json($product->slug);
            var captureDiv = document.getElementById('captureDiv');
            html2canvas(captureDiv).then(function(canvas) {
                var img = canvas.toDataURL("image/png");
                var downloadLink = document.createElement("a");
                downloadLink.href = img;
                downloadLink.download = image_name + "_document.png";
                downloadLink.click();
            });
        }
        document.getElementById("downloadBtn").addEventListener("click", captureAndDownload);
    </script>
@endpush
