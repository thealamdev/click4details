@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Products Datalist</h4>
            <p class="mb-0">Manage all the vehicle products</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('merchant.vehicle.product.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('merchant.vehicle.product.index') }}">
                        Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card rounded border border-gray-300 mb-3">
                <div class="card-body">
                    <form action="{{ route('merchant.vehicle.product.storeCustomTable') }}" method="POST">
                        @csrf
                        <input type="checkbox" {{ $custom?->app == 1 ? 'checked' : '' }} name="app">
                        <label for="app">App</label> &nbsp;

                        <input type="checkbox" {{ $custom?->sl == 1 ? 'checked' : '' }} name="sl">
                        <label for="app">Sl</label>&nbsp;

                        <input type="checkbox" {{ $custom?->brand_id == 1 ? 'checked' : '' }} name="brand_id">
                        <label for="app">Brand</label>&nbsp;

                        <input type="checkbox" {{ $custom?->carmodel_id == 1 ? 'checked' : '' }} name="carmodel_id">
                        <label for="app">Model</label>&nbsp;

                        <input type="checkbox" {{ $custom?->manufacture == 1 ? 'checked' : '' }} name="manufacture">
                        <label for="app">Mfg Yr</label>&nbsp;

                        <input type="checkbox" {{ $custom?->registration == 1 ? 'checked' : '' }} name="registration">
                        <label for="app">Reg Yr</label>&nbsp;

                        <input type="checkbox" {{ $custom?->condition_id == 1 ? 'checked' : '' }} name="condition_id">
                        <label for="app">Con</label>&nbsp;

                        <input type="checkbox" {{ $custom?->edition_id == 1 ? 'checked' : '' }} name="edition_id">
                        <label for="app">Edi</label>&nbsp;

                        <input type="checkbox" {{ $custom?->fuel_id == 1 ? 'checked' : '' }} name="fuel_id">
                        <label for="app">Fuel</label>&nbsp;

                        <input type="checkbox" {{ $custom?->mileage_id == 1 ? 'checked' : '' }} name="mileage_id">
                        <label for="app">Mileage</label>&nbsp;

                        <input type="checkbox" {{ $custom?->grade_id == 1 ? 'checked' : '' }} name="grade_id">
                        <label for="app">Grade</label>&nbsp;

                        <input type="checkbox" {{ $custom?->feature == 1 ? 'checked' : '' }} name="feature">
                        <label for="app">Feature</label>&nbsp;

                        <input type="checkbox" {{ $custom?->purchase_price == 1 ? 'checked' : '' }} name="purchase_price">
                        <label for="app">Purchse Tk</label>&nbsp;

                        <input type="checkbox" {{ $custom?->price == 1 ? 'checked' : '' }} name="price">
                        <label for="app">Asking Tk</label>&nbsp;

                        <input type="checkbox" {{ $custom?->fixed_price == 1 ? 'checked' : '' }} name="fixed_price">
                        <label for="app">Fixed Tk</label>&nbsp;

                        <input type="checkbox" {{ $custom?->available_id == 1 ? 'checked' : '' }} name="available_id">
                        <label for="app">Available</label>&nbsp;

                        <input type="checkbox" {{ $custom?->slug == 1 ? 'checked' : '' }} name="slug">
                        <label for="app">Title</label>&nbsp;

                        <input type="checkbox" {{ $custom?->skeleton_id == 1 ? 'checked' : '' }} name="skeleton_id">
                        <label for="app">Skeleton</label>&nbsp;

                        <input type="checkbox" {{ $custom?->power == 1 ? 'checked' : '' }} name="power">
                        <label for="app">Power</label>&nbsp;

                        <input type="checkbox" {{ $custom?->chassis_number == 1 ? 'checked' : '' }} name="chassis_number">
                        <label for="app">Chassis No.</label>&nbsp;

                        <input type="checkbox" {{ $custom?->engine_number == 1 ? 'checked' : '' }} name="engine_number">
                        <label for="app">Engine No</label>&nbsp;

                        <input type="checkbox" {{ $custom?->link == 1 ? 'checked' : '' }} name="link">
                        <label for="app">Link</label>&nbsp;

                        <input type="checkbox" {{ $custom?->status == 1 ? 'checked' : '' }} name="status">
                        <label for="app">Status</label>&nbsp;

                        <input type="checkbox" {{ $custom?->action == 1 ? 'checked' : '' }} name="action">
                        <label for="app">Action</label>&nbsp;

                        <input type="checkbox" {{ $custom?->modified == 1 ? 'checked' : '' }} name="modified">
                        <label for="app">Modified</label>&nbsp;

                        <input type="checkbox" {{ $custom?->code == 1 ? 'checked' : '' }} name="code">
                        <label for="app">Code</label>

                        <button type="submit" class="btn btn-sm btn-success">Add</button>
                    </form>
                    <form action="{{ route('merchant.vehicle.product.storeDefaultTable') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Default</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        @if ($custom?->app == 1)
                            <th class="align-middle">App</th>
                        @endif

                        <th>Purchase Price</th>

                        @if ($custom?->sl == 1)
                            <th class="align-middle">Sl</th>
                        @endif

                        @if ($custom?->brand_id)
                            <th class="align-middle">Brand</th>
                        @endif

                        @if ($custom?->carmodel_id == 1)
                            <th class="align-middle">Model</th>
                        @endif

                        @if ($custom?->manufacture == 1)
                            <th class="align-middle">Mfg Yr</th>
                        @endif

                        @if ($custom?->registration == 1)
                            <th class="align-middle">Reg Yr</th>
                        @endif

                        @if ($custom?->condition_id == 1)
                            <th class="align-middle">Cond</th>
                        @endif

                        @if ($custom?->edition_id == 1)
                            <th class="align-middle">Edi</th>
                        @endif

                        @if ($custom?->fuel_id == 1)
                            <th class="align-middle">Fuel</th>
                        @endif

                        @if ($custom?->mileage_id == 1)
                            <th class="align-middle">Mileage</th>
                        @endif

                        @if ($custom?->grade_id == 1)
                            <th class="align-middle">Grade</th>
                        @endif

                        @if ($custom?->feature == 1)
                            <th class="align-middle">Features</th>
                        @endif

                        @if ($custom?->purchase_price == 1)
                            <th class="align-middle">Purchase Tk</th>
                        @endif

                        @if ($custom?->price == 1)
                            <th class="align-middle">Asking Tk</th>
                        @endif

                        @if ($custom?->fixed_price == 1)
                            <th class="align-middle">Fixed Tk</th>
                        @endif

                        @if ($custom?->available_id == 1)
                            <th class="align-middle">Available</th>
                        @endif

                        @if ($custom?->link == 1)
                            <th class="align-middle">Link</th>
                        @endif

                        @if ($custom?->slug == 1)
                            <th class="align-middle">Title</th>
                        @endif

                        @if ($custom?->skeleton_id == 1)
                            <th class="align-middle">Skeleton</th>
                        @endif

                        @if ($custom?->power == 1)
                            <th class="align-middle">Power</th>
                        @endif

                        @if ($custom?->chassis_number == 1)
                            <th class="align-middle">Chassis No.</th>
                        @endif

                        @if ($custom?->engine_number == 1)
                            <th class="align-middle">Engine No.</th>
                        @endif

                        @if ($custom?->status == 1)
                            <th class="align-middle">Status</th>
                        @endif

                        @if ($custom?->action == 1)
                            <th class="align-middle text-danger">Action</th>
                        @endif

                        @if ($custom?->modified == 1)
                            <th class="align-middle">Modified</th>
                        @endif

                        @if ($custom?->code == 1)
                            <th class="align-middle">Code</th>
                        @endif

                    </tr>

                </thead>

                <tbody>
                    @if (is_object($products) && $products->count() > 0)
                        @foreach ($products as $n => $each)
                            <tr>
                                @if ($custom?->app == 1)
                                    <td>
                                        @php
                                            $arr = $each?->description->pluck('content');
                                            $des = Arr::first($arr);
                                        @endphp

                                        <button title="Send to WhatsApp"
                                            onclick="sendToWhatsApp('{{ $each?->vehicle_feature->where('vehicle_id', $each->id) }}','{{ $each->id }}','{{ toLocaleString($each?->translate) }}','{{ toLocaleString($each?->carmodel?->translate) }}','{{ $each->registration }}','{{ toLocaleString($each?->engine?->translate) }}','{{ toLocaleString($each?->mileage?->translate) }}','{{ $each?->price }}','{{ toLocaleString($each?->fuel?->translate) }}','{{ route('merchant.view', ['product' => $each?->slug]) }}')"
                                            class="send-whatsapp-button btn btn-sccess">
                                            <img src="{{ asset('images/whatsapp.png') }}" width="40px">
                                        </button>
                                    </td>
                                @endif

                                <td>
                                    <a href="{{ route('merchant.vehicle.purchase-price.index', ['vehicle' => $each?->id]) }}"
                                        class="btn btn-sm btn-primary">
                                        Purchase
                                    </a>
                                </td>

                                @if ($custom?->sl == 1)
                                    <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td>
                                @endif

                                @if ($custom?->brand_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->brand?->translate) }}</td>
                                @endif

                                @if ($custom?->carmodel_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->carmodel?->translate) }}</td>
                                @endif

                                @if ($custom?->manufacture == 1)
                                    <td class="fw-500">{{ $each->manufacture }}</td>
                                @endif

                                @if ($custom?->registration == 1)
                                    <td class="fw-500">{{ $each->registration }}</td>
                                @endif

                                @if ($custom?->condition_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->condition?->translate) }}</td>
                                @endif

                                @if ($custom?->edition_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->edition?->translate) }}</td>
                                @endif

                                @if ($custom?->fuel_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->fuel?->translate) }}</td>
                                @endif

                                @if ($custom?->mileage_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->mileage?->translate) }}</td>
                                @endif

                                @if ($custom?->grade_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->grade?->translate) }}</td>
                                @endif

                                @if ($custom?->feature == 1)
                                    <td class="fw-500">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            title="Feature && Details" data-bs-target="#detailModal{{ $each->id }}">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </button>

                                        <div class="modal fade" id="detailModal{{ $each->id }}" tabindex="-1"
                                            aria-labelledby="detailLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailLabel">Feature && Details of
                                                            {{ toLocaleString($each?->translate) }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @php
                                                            $featurDetails = $each?->vehicle_feature->where(
                                                                'vehicle_id',
                                                                $each->id,
                                                            );
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
                                    </td>
                                @endif

                                @if ($custom?->fixed_price == 1)
                                    <td>
                                        {{ sprintf('Tk %s', number_format($each->fixed_price)) }}
                                        <input type="radio" name="price{{ $each->id }}"
                                            class="fixed-price-checkbox" data-price="{{ $each?->fixed_price }}">
                                    </td>
                                @endif

                                @if ($custom?->price == 1)
                                    <td class="fw-500">{{ sprintf('Tk %s', number_format($each->price)) }}
                                        <input type="radio" name="price{{ $each->id }}" class="price-checkbox"
                                            data-price="{{ $each->price }}">
                                    </td>
                                @endif

                                @if ($custom?->purchase_price == 1)
                                    <td>
                                        {{ sprintf('Tk %s', number_format($each->purchase_price)) }}
                                        <input type="radio" name="price{{ $each->id }}"
                                            class="purchase-price-checkbox" data-price="{{ $each?->purchase_price }}">
                                    </td>
                                @endif

                                @if ($custom?->available_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->available?->translate) }}</td>
                                @endif

                                @if ($custom?->link == 1)
                                    <td class="fw-500">
                                        <a href="{{ route('merchant.view', ['product' => $each?->slug]) }}"
                                            target="_blank">Link</a>
                                    </td>
                                @endif

                                @if ($custom?->slug == 1)
                                    <td>
                                        <a href="{{ route('home.detail', ['slug' => $each->slug]) }}"
                                            class="list-group-item list-group-item-action d-flex align-items-center text-body">
                                            <div class="flex-fill">
                                                <div class="fw-semibold">{{ toLocaleString($each?->translate) }}</div>
                                                <div class="text-blue-600 fs-12 fw-500">
                                                    {{ sprintf('@%s', $each?->merchant?->name) . '-' . $each?->code }}
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                @endif

                                @if ($custom?->skeleton_id == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->skeleton?->translate) }}</td>
                                @endif

                                @if ($custom?->power == 1)
                                    <td class="fw-500">{{ toLocaleString($each?->engine?->translate) }}</td>
                                @endif

                                @if ($custom?->chassis_number == 1)
                                    <td class="fw-500">{{ $each?->chassis_number }}</td>
                                @endif

                                @if ($custom?->engine_number == 1)
                                    <td class="fw-500">{{ $each?->engine_number }}</td>
                                @endif

                                @if ($custom?->status == 1)
                                    <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                                @endif

                                @if ($custom?->action == 1)
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="javascript:;" data-bs-toggle="dropdown"
                                                class="text-body text-opacity-50" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('merchant.vehicle.product.edit', ['product' => $each->id]) }}"
                                                    class="dropdown-item text-danger">Edit</a>
                                                {{-- <form
                                                    action="{{ route('merchant.vehicle.product.delete', ['product' => $each->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Trash</button>
                                                </form> --}}
                                                <a href="{{ route('merchant.vehicle.description.index', ['vehicle' => $each->id]) }}"
                                                    class="dropdown-item">Detail</a>
                                                <a href="{{ route('merchant.vehicle.gallery.index', ['vehicle' => $each->id]) }}"
                                                    class="dropdown-item">Gallery</a>
                                            </div>
                                        </div>
                                    </td>
                                @endif

                                @if ($custom?->modified == 1)
                                    <td>{{ $each->updated_at->diffForHumans() }}</td>
                                @endif

                                @if ($custom?->code == 1)
                                    <td class="fw-500">{{ $each?->code }}</td>
                                @endif

                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>

        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/backend/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [20, 40, 60, 100, -1],
                    [20, 40, 60, 100, "All"]
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdfHtml5', 'print'
                ]
            });
        });
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
            messageContent.push(`Click Details: ${image}`);
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
                        prefix = "Price: ";
                    } else if (i === 1) {
                        prefix = "Price: ";
                    } else if (i === 2) {
                        prefix = "Price: ";
                    }

                    price = prefix + priceRadios[i].getAttribute('data-price');
                    return price;
                }
            }

        }
    </script>
@endpush
