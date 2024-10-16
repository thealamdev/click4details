@extends('layouts.public')
@section('title', 'Stock List')
@section('css')
    <style>
        .green_color {
            color: #0dc40d;
        }

        .bg_green {
            color: #0dc40d !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h4>{{ $vehicles->first()->merchant->merchantInfo?->company_name ?? $vehicles->first()->merchant->name }} (Stock List)</h4>
            </div>
        </div>

        <div class="col-12">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-2 g-lg-3 mb-4">
                @if (count($vehicles) > 0)
                    @foreach ($vehicles as $each)
                        <div class="col">
                            <div class="card rounded shadow-sm border border-slate-200">
                                <a style="text-decoration: none;color: var(--bs-heading-color)">
                                    <div class="card-body p-2">
                                        <a href="{{ route('merchant.view', ['product' => $each?->slug]) }}">
                                            <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                                class="card-img-top rounded" loading="lazy" alt="" />
                                        </a>

                                        <h5 class="fs-16 fw-500 mt-2 mb-0">{{ toLocaleString($each?->translate) }} <span
                                                class="text-danger"></span>
                                            <div class="text-blue-600 fs-12 fw-500">
                                                {{ sprintf('@%s', $each?->merchant?->name) }}
                                            </div>
                                        </h5>

                                        <div class="main d-flex justify-content-between">
                                            <p class="fs-12 d-flex gap-1">
                                                <span>
                                                    @if ($each->registration)
                                                        <i class="fa-solid fa-registered me-1"></i>
                                                        {{ toLocaleNumber($each->registration) }}
                                                    @else
                                                        <span><i class="fa-solid fa-shield-halved me-1"></i>
                                                            {{ toLocaleString($each->grade?->translate) }}</span>
                                                    @endif
                                                </span>
                                                <span>|</span>
                                                <span>{{ toLocaleString($each->condition?->translate) }}</span>
                                                <span>|</span>
                                                <span><i class="fa-solid fa-mill-sign"></i>
                                                    {{ toLocaleString($each->mileage?->translate) }}</span>
                                            </p>

                                            <div class="detail-icon">
                                                {{-- <p >Features</p> --}}
                                                <button class="btn btn-sm rounded-circle" style="background: green"
                                                    data-bs-toggle="modal" title="Feature & Details"
                                                    data-bs-target="#detailModal{{ $each->id }}">
                                                    <i class="fa-solid fa-circle-info"
                                                        style="color:#fff;font-size:14px;text-align:center;line-height:21px"></i>
                                                </button>

                                                <div class="modal fade" id="detailModal{{ $each->id }}" tabindex="-1"
                                                    aria-labelledby="detailLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailLabel">Feature &&
                                                                    Details of {{ toLocaleString($each?->translate) }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                @php
                                                                    $featurDetails = $each?->vehicle_feature->where('vehicle_id', $each->id);
                                                                    $seenTitles = [];
                                                                @endphp
                                                                <div class="row">
                                                                    @foreach ($featurDetails as $featureDetail)
                                                                        @php
                                                                            $title = $featureDetail->feature->title;
                                                                        @endphp
                                                                        @if (!in_array($title, $seenTitles))
                                                                            @php
                                                                                $seenTitles[] = $title;
                                                                            @endphp
                                                                            <div class="col-lg-3">
                                                                                <h4>{{ $title }}</h4>
                                                                                @foreach ($featurDetails as $detail)
                                                                                    @if ($detail->feature->title === $title)
                                                                                        <p>{{ $detail->detail->title }}</p>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="d-flex justify-content-between">
                                            @php
                                                $value = '';

                                                if (toLocaleString($each?->available?->translate) === 'Available at Friends Showroom') {
                                                    $value = 'Available My Showroom';
                                                } else {
                                                    $value = toLocaleString($each?->available?->translate);
                                                }

                                            @endphp

                                            @if ($each?->available)
                                                <span>{{ $value }}</span>
                                            @endif

                                            {{ $each->updated_at->diffForHumans() }}
                                        </p>

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="card-text">
                                                @if (base64_decode($price_type) == 'fixed_price')
                                                    <h4 class="fs-16 fw-500 m-0">
                                                        @if ($each && $each->fixed_price)
                                                            <label for="fixed_price">Fixed Price: </label>
                                                            {{ sprintf('Tk %s', number_format($each->fixed_price, 2)) }}
                                                        @endif
                                                    </h4>
                                                @endif

                                                @if (base64_decode($price_type) == 'asking_price')
                                                    <h5 class="fs-16 fw-500 m-0">
                                                        @if ($each && $each->price)
                                                             
                                                            <label for="price"><span class="green_color">Asking
                                                                    Price:</span> </label>
                                                            {{ sprintf('Tk %s', number_format($each->price, 2)) }}
                                                        @endif
                                                    </h5>
                                                @endif
                                            </div>

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

@push('script')
    <script>
        function editVehicle(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('merchant.vehicle.product.vehicleEdit') }}",
                dataType: 'json',
                data: {
                    vehicle_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    let purchasePriceEdit = document.querySelectorAll('.purchasePriceEdit');
                    let fixedPriceEdit = document.querySelectorAll('.fixedPriceEdit');
                    let priceEdit = document.querySelectorAll('.priceEdit');
                    let availableEdit = document.querySelector('.availableEdit' + data.vehicle.id);

                    purchasePriceEdit.forEach(element => {
                        element.value = data.vehicle.purchase_price
                    });

                    fixedPriceEdit.forEach(element => {
                        element.value = data.vehicle.fixed_price
                    });

                    priceEdit.forEach(element => {
                        element.value = data.vehicle.price
                    });

                    for (const key in data.availables) {
                        const option = document.createElement('option');
                        let value;
                        if (data.availables[key] === 'Available at Friends Showroom') {
                            value = 'Available My Showroom'
                        } else {
                            value = data.availables[key];
                        }
                        option.value = key;
                        option.text = value;

                        if (data.availables[key] == data.available) {
                            option.setAttribute('selected', 'selected');
                        }

                        availableEdit.appendChild(option);
                    }

                },
            });
        }
    </script>
@endpush
