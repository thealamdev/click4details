@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('merchant.stockList') }}" method="GET">
                            <div class="form-content d-flex justify-content-between">
                                <div class="mt-3 ps-3">
                                    <input type="radio" class="fixed_price" name="price"
                                        value="{{ base64_encode('fixed_price') }} ">
                                    <label for="fixed_price" class="fs-5">Fixed Price </label>
                                </div>

                                <div class="mt-3 ps-3">
                                    <input type="radio" name="price" value="{{ base64_encode('asking_price') }}">
                                    <label for="asking_price" class="fs-5 green_color">Asking Price </label>
                                </div>
                                <input type="hidden" name="merchant_id" value="{{ base64_encode($merchant_id ?? 0) }}">

                                <button class="btn btn-success ms-5" type="submit">SEND STOCK LIST</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded border border-gray-300 mb-2">
                    <div class="card-body">
                        <form action="{{ route('merchant.vehicle.product.secure') }}" method="GET">
                            <div class="row">

                                <div class="col-lg-2 mb-2">
                                    <input type="text" name="vehicles_name" value="{{ request()->vehicles_name }}"
                                        placeholder="Search by Name" class="form-control">
                                </div>

                                <div class="col-lg-2 mb-2">
                                    <input type="text" class="form-control" name="code"
                                        placeholder="Seach by Vehicles Code" class="form-control"
                                        value="{{ request()->code }}">
                                </div>

                                <div class="col-lg-2 mb-2">
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

                                <div class="col-lg-2 mb-2">
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ request()->start_date }}">
                                </div>

                                <div class="col-lg-2 mb-2">
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ request()->end_date }}">
                                </div>

                                <div class="col-lg-2 mb-2">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <button class="btn btn-success w-100">Search</button>
                                        </div>

                                        <div class="col-lg-6">
                                            <a href="{{ route('merchant.vehicle.product.show') }}"><button type="button"
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
                @if (count($products) > 0)
                    @foreach ($products as $each)
                        <div class="col">
                            <div class="card rounded shadow-sm border border-slate-200">
                                <a style="text-decoration: none;color: var(--bs-heading-color)">
                                    <div class="card-body p-2">
                                        <div class="icon mb-2" style="font-size:20px;cursor: pointer;text-align:right">
                                            @if (request()->routeIs('admin.*'))
                                                <button class="btn btn-sm rounded-circle" style="background: green"
                                                    onclick="editVehicle({{ $each->id }})" type="button"
                                                    class="bg-transparent border-0" data-bs-toggle="modal"
                                                    data-bs-target="#editVehicle{{ $each->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            @endif

                                        </div>

                                        <div class="modal fade" id="editVehicle{{ $each->id }}" tabindex="-1"
                                            aria-labelledby="editVehicle{{ $each->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editVehicle{{ $each->id }}">Edit
                                                            Vehicle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('customer-care.vehicle.product.vehicleUpdate', ['product' => $each->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <div class="col-lg-12">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label fw-500 mb-1"
                                                                        for="purchase_price">Purchase Price</label> <span
                                                                        class="text-danger"></span>
                                                                    <input type="number"
                                                                        placeholder="enter purchase price"
                                                                        class="form-control purchasePriceEdit @error(' purchase_price') {{ 'is-invalid' }} @enderror"
                                                                        name="purchase_price"
                                                                        value="{{ old('purchase_price') }}" />
                                                                    @error('purchase_price')
                                                                        <div class="invalid-feedback text-red-600">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label class="form-label fw-500 mb-1"
                                                                        for="fixed_price">Fixed Price</label> <span
                                                                        class="text-danger">*</span>
                                                                    <input type="number" placeholder="enter fixed price"
                                                                        class="form-control fixedPriceEdit @error('fixed_price') {{ 'is-invalid' }} @enderror"
                                                                        name="fixed_price"
                                                                        value="{{ old('fixed_price') }}" />
                                                                    @error('fixed_price')
                                                                        <div class="invalid-feedback text-red-600">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label class="form-label fw-500 mb-1" for="price">
                                                                        Asking
                                                                        Price</label> <span class="text-danger"></span>
                                                                    <input type="number" placeholder="enter price"
                                                                        class="form-control priceEdit @error('price') {{ 'is-invalid' }} @enderror"
                                                                        name="price" value="{{ old('price') }}" />
                                                                    @error('price')
                                                                        <div class="invalid-feedback text-red-600">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label class="form-label fw-500 mb-1"
                                                                        for="available_id">Availabe</label> <span
                                                                        class="text-danger">*</span>

                                                                    <select name="available_id"
                                                                        class="form-control availableEdit{{ $each->id }}">
                                                                        <option>Please Select Avaible</option>
                                                                    </select>

                                                                    @error('available_id')
                                                                        <div class="invalid-feedback text-red-600">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mt-4 d-flex justify-content-between">
                                                                    <button type="submit"
                                                                        class="btn btn-success border-0">
                                                                        <i class="fa-solid fa-plus me-1"></i>Confirm &
                                                                        Submit
                                                                    </button>

                                                                    <a class="btn btn-danger"
                                                                        href="{{ route('customer-care.vehicle.product.edit', ['product' => $each->id]) }}">Advanced
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('merchant.view', ['product' => $each?->slug]) }}">
                                            <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                                class="card-img-top rounded" loading="lazy" alt="" />
                                        </a>

                                        <h5 class="fs-16 fw-500 mt-2 mb-0">{{ toLocaleString($each?->translate) }} <span
                                                class="text-danger">{{ '-- ' . $each?->code }}</span>
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
                                                    {{ $each->mileages }}</span>
                                            </p>

                                            <div class="detail-icon">
                                                <button class="btn btn-sm rounded-circle" style="background: green"
                                                    data-bs-toggle="modal" title="Feature & Details"
                                                    data-bs-target="#detailModal{{ $each->id }}">
                                                    <i class="fa-solid fa-circle-info"
                                                        style="color:#fff;font-size:14px;text-align:center;line-height:21px"></i>
                                                </button>

                                                <div class="modal fade" id="detailModal{{ $each->id }}"
                                                    tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
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
                                                <h4 class="fs-16 fw-500 m-0">
                                                    @if ($each && $each->purchase_price)
                                                        {{-- <input type="radio" name="price{{ $each->id }}"
                                                        class="purchase-price-checkbox"
                                                        data-price="{{ $each?->purchase_price }}"> --}}
                                                        <label for="purchase_price">Purchase Price: </label>
                                                        {{ sprintf('Tk %s', number_format($each->purchase_price, 2)) }}
                                                    @endif
                                                </h4>

                                                <h4 class="fs-16 fw-500 m-0">
                                                    @if ($each && $each->fixed_price)
                                                        <input type="radio" name="price{{ $each->id }}"
                                                            class="fixed-price-checkbox"
                                                            data-price="{{ $each?->fixed_price }}">
                                                        <label for="fixed_price">Fixed Price: </label>
                                                        {{ sprintf('Tk %s', number_format($each->fixed_price, 2)) }}
                                                    @endif
                                                </h4>

                                                <h4 class="fs-16 fw-500 m-0">
                                                    @if ($each && $each->price)
                                                        <input type="radio" name="price{{ $each->id }}"
                                                            class="price-checkbox" data-price = "{{ $each?->price }}">
                                                        <label for="price"><span class="green_color">Asking
                                                                Price:</span> </label>
                                                        {{ sprintf('Tk %s', number_format($each->price, 2)) }}
                                                    @endif
                                                </h4>
                                            </div>

                                            <div class="card-whatsapp" style="margin-right: -10px">
                                                <button title="Send to WhatsApp"
                                                    onclick="sendToWhatsApp('{{ $each?->vehicle_feature->where('vehicle_id', $each->id) }}','{{ $each->id }}','{{ toLocaleString($each?->translate) }}','{{ toLocaleString($each?->carmodel?->translate) }}','{{ $each->registration }}','{{ toLocaleString($each?->engine?->translate) }}','{{ toLocaleString($each?->mileage?->translate) }}','{{ $each?->price }}','{{ toLocaleString($each?->fuel?->translate) }}','{{ route('merchant.view', ['product' => $each?->slug]) }}')"
                                                    class="send-whatsapp-button btn btn-sccess">
                                                    <img src="https://cdn.pixabay.com/photo/2021/05/22/11/38/whatsapp-6273368_1280.png"
                                                        width="30px">
                                                </button>

                                                {{-- <button type="button" class="btn btn-primary bg-transparent border-0"
                                            data-bs-toggle="modal" data-bs-target="#sendMail{{ $each->id }}">
                                            <img src="https://cdn.pixabay.com/photo/2019/10/19/17/24/gmail-4561841_1280.png"
                                                width="30px">
                                        </button> --}}

                                                <div class="modal fade" id="sendMail{{ $each->id }}" tabindex="-1"
                                                    aria-labelledby="sendMailLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="sendMailLabel">Send Mail
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('merchant.vehicle.product.sendMail') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $each->id }}">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group mb-3">
                                                                            <label class="form-label fw-500 mb-1"
                                                                                for="title[bn]">Client Email</label> <span
                                                                                class="text-danger">*</span>
                                                                            <input type="email"
                                                                                placeholder="Client mail account"
                                                                                class="form-control @error('email') {{ 'is-invalid' }} @enderror"
                                                                                name="email"
                                                                                value="{{ old('email') }}" required />
                                                                            @error('email')
                                                                                <div class="invalid-feedback text-red-600">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="mt-4 d-flex">
                                                                            <button type="submit"
                                                                                class="btn btn-dark border-0">
                                                                                <i class="fa-solid fa-plus me-1"></i>Send
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
                url: '{{ route('customer-care.vehicle.product.vehicleEdit') }}',
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

    <script>
        function sendToWhatsApp(data, id, name, model, reg, engine, mileage, price, fuel, image) {
            var jsonString = data;
            var dataArray = JSON.parse(jsonString);

            const selectedPrice = getSelectedPrice(id);

            const uniqueFeatureTitles = new Set();
            const detailsByFeature = {};

            for (const key in dataArray) {
                if (dataArray.hasOwnProperty(key) && dataArray[key].feature && dataArray[key].feature.title) {
                    const featureTitle = dataArray[key].feature.title;
                    const detailTitle = dataArray[key].detail.title;

                    if (!uniqueFeatureTitles.has(featureTitle)) {
                        uniqueFeatureTitles.add(featureTitle);
                        detailsByFeature[featureTitle] = [detailTitle];
                    } else {
                        detailsByFeature[featureTitle].push(detailTitle);
                    }
                }
            }

            const messageContent = [];

            // messageContent.push(`Basic Detail: ------\n`);
            messageContent.push(`Vehicle Name: ${name}`);
            messageContent.push(`Model: ${model}`);
            messageContent.push(`Registration: ${reg}`);
            messageContent.push(`Engine: ${engine}`);
            messageContent.push(`Mileage: ${mileage}`);
            messageContent.push(`Fuel: ${fuel}`);
            // messageContent.push(`Feature && Details: ------\n`);
            for (const featureTitle of uniqueFeatureTitles) {
                const detailTitles = detailsByFeature[featureTitle];
                messageContent.push(`${featureTitle}: ${detailTitles.join(', ')}`);
            }

            messageContent.push(`${selectedPrice} Tk`);
            messageContent.push(`Images: ${image}`);

            const message = messageContent.join('\n');
            const encodedMessage = encodeURIComponent(message);

            const whatsappLink = `https://wa.me/?text=${encodedMessage}`;
            window.open(whatsappLink, "_blank");
        }

        function getSelectedPrice(id) {
            const priceRadios = document.getElementsByName("price" + id);
            var prefix;
            for (let i = 0; i < priceRadios.length; i++) {
                if (priceRadios[i].checked) {
                    let prefix = "";
                    if (i === 0) {
                        prefix = "Fixed Price: ";
                    } else if (i === 1) {
                        prefix = "Asking Price: ";
                    }
                    price = prefix + priceRadios[i].getAttribute('data-price');
                    return price;
                }
            }

        }
    </script>
@endpush
