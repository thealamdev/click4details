@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Products Datalist</h4>
            <p class="mb-0">Manage all the vehicle products</p>
        </div>
    </div>

    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="align-middle">App</th>
                        <th class="align-middle">Sl</th>
                        <th class="align-middle">Brand</th>
                        <th class="align-middle">Model</th>
                        <th class="align-middle">Mfg Yr</th>
                        <th class="align-middle">Reg Yr</th>
                        <th class="align-middle">Cond</th>
                        <th class="align-middle">Edi</th>
                        <th class="align-middle">Fuel</th>
                        <th class="align-middle">Mileage</th>
                        <th class="align-middle">Grade</th>
                        <th class="align-middle">Features</th>
                        <th class="align-middle">Purchase Tk</th>
                        <th class="align-middle">Asking Tk</th>
                        <th class="align-middle">Fixed Tk</th>
                        <th class="align-middle">Available</th>
                        <th class="align-middle">Link</th>
                        <th class="align-middle">Title</th>
                        <th class="align-middle">Skeleton</th>
                        <th class="align-middle">Power</th>
                        <th class="align-middle">Chassis No.</th>
                        <th class="align-middle">Engine No.</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle text-danger">Action</th>
                        <th class="align-middle">Modified</th>
                        <th class="align-middle">Code</th>
                    </tr>

                </thead>

                <tbody>
                    @if (is_object($products) && $products->count() > 0)
                        @foreach ($products as $n => $each)
                            <tr>

                                <td>
                                    @php
                                        $arr = $each?->description->pluck('content');
                                        $des = Arr::first($arr);
                                    @endphp

                                    <button title="Send to WhatsApp"
                                        onclick="sendToWhatsApp('{{ $each?->vehicle_feature->where('vehicle_id', $each->id) }}','{{ $each->id }}','{{ toLocaleString($each?->translate) }}','{{ toLocaleString($each?->carmodel?->translate) }}','{{ $each->registration }}','{{ toLocaleString($each?->engine?->translate) }}','{{ toLocaleString($each?->mileage?->translate) }}','{{ $each?->price }}','{{ toLocaleString($each?->fuel?->translate) }}','{{ route('merchant.view', ['product' => $each?->slug]) }}')"
                                        class="send-whatsapp-button btn btn-sccess">
                                        <img src="https://cdn.pixabay.com/photo/2021/05/22/11/38/whatsapp-6273368_1280.png"
                                            width="30px">
                                    </button>
                                </td>

                                <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->brand?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->carmodel?->translate) }}</td>
                                <td class="fw-500">{{ $each->manufacture }}</td>
                                <td class="fw-500">{{ $each->registration }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->condition?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->edition?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->fuel?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->mileage?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->grade?->translate) }}</td>
                                <td class="fw-500">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" title="Feature && Details"
                                        data-bs-target="#detailModal{{ $each->id }}">
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
                                </td>
                                <td>
                                    {{ sprintf('Tk %s', number_format($each->fixed_price)) }}
                                    <input type="radio" name="price{{ $each->id }}" class="fixed-price-checkbox"
                                        data-price="{{ $each?->fixed_price }}">
                                </td>
                                <td class="fw-500">{{ sprintf('Tk %s', number_format($each->price)) }}
                                    <input type="radio" name="price{{ $each->id }}" class="price-checkbox"
                                        data-price="{{ $each->price }}">
                                </td>
                                <td>
                                    {{ sprintf('Tk %s', number_format($each->purchase_price)) }}
                                    <input type="radio" name="price{{ $each->id }}" class="purchase-price-checkbox"
                                        data-price="{{ $each?->purchase_price }}">
                                </td>
                                <td class="fw-500">{{ toLocaleString($each?->available?->translate) }}</td>
                                {{-- need to work with it. --}}
                                <td class="fw-500">
                                    <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}" target="_blank">Link</a>
                                </td>
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

                                <td class="fw-500">{{ toLocaleString($each?->skeleton?->translate) }}</td>

                                <td class="fw-500">{{ toLocaleString($each?->engine?->translate) }}</td>

                                <td class="fw-500">{{ $each?->chassis_number }}</td>

                                <td class="fw-500">{{ $each?->engine_number }}</td>

                                <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>

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

                                <td>{{ $each->updated_at->diffForHumans() }}</td>
                                <td class="fw-500">{{ $each?->code }}</td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>

        </div>
    </div>
@endsection

@push('script')
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
