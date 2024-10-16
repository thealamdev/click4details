<table id="dataTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th rowspan="2" class="align-middle">Sl</th>
            <th rowspan="2" class="align-middle">Title</th>
            <th rowspan="2" class="align-middle">Brand</th>
            <th rowspan="2" class="align-middle">Engine Num</th>
            <th rowspan="2" class="align-middle">Chassis Num</th>
            <th colspan="7">Specification</th>
            <th rowspan="2" class="align-middle">Fixed Price</th>
            <th rowspan="2" class="align-middle">Purchase Price</th>
            <th rowspan="2" class="align-middle">Asking Price</th>
            <th rowspan="2" class="align-middle">Additional Price</th>
            <th colspan="2">Years</th>
            <th rowspan="2" class="align-middle">Status</th>
            <th rowspan="2" class="align-middle text-danger">Action</th>
            <th rowspan="2" class="align-middle">Modified</th>
            <th rowspan="2" class="align-middle">App</th>
        </tr>
        <tr>
            <th>Edition</th>
            <th>Condition</th>
            <th>Code</th>
            <th>Engine</th>
            <th>Fuel</th>
            <th>Skeleton</th>
            <th>Mileage</th>
            <th>Reg.</th>
            <th>Model Year.</th>
        </tr>
    </thead>

    <tbody>
        @if (is_object($products) && $products->count() > 0)
            @foreach ($products as $n => $each)
                <tr>
                    <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td>
                    <td>
                        <a href="{{ route('home.detail', ['slug' => $each->slug]) }}"
                            class="list-group-item list-group-item-action d-flex align-items-center text-body">
                            <div class="flex-fill">
                                <div class="fw-semibold">{{ toLocaleString($each->translate) }}</div>
                                <div class="text-blue-600 fs-12 fw-500">
                                    @if (auth()->user()->role == 'Admin' || $each?->merchant?->name === 'Pilot Bazaar Automobiles')
                                        {{ sprintf('@%s', $each?->merchant?->name) . '-' . $each?->code }}
                                    @else
                                        {{ $each?->code }}
                                    @endif
                                </div>
                            </div>
                        </a>
                    </td>
                    <td class="fw-500">{{ toLocaleString($each?->brand?->translate) }}</td>
                    <td class="fw-500">{{ $each?->engine_number }}</td>
                    <td class="fw-500">{{ $each?->chassis_number }}</td>
                    <td class="fw-500">{{ toLocaleString($each?->edition?->translate) }}</td>
                    <td class="fw-500">{{ toLocaleString($each?->condition?->translate) }}</td>
                    <td class="fw-500">{{ $each?->code }}</td>
                    <td class="fw-500">
                        @if (!empty($each?->engines))
                            {{ $each?->engines }}
                        @else
                            {{ toLocaleString($each?->engine?->translate) }}
                        @endif
                    </td>
                    <td class="fw-500">{{ toLocaleString($each?->fuel?->translate) }}</td>
                    <td class="fw-500">{{ toLocaleString($each?->skeleton?->translate) }}</td>
                    <td class="fw-500">
                        @if (!empty($each?->mileages))
                            {{ $each?->mileages }}
                        @else
                            {{ toLocaleString($each?->mileage?->translate) }}
                        @endif
                    </td>
                    <td>
                        {{ sprintf('Tk %s', number_format($each->fixed_price)) }}
                        <input type="radio" name="price" class="fixed-price-checkbox"
                            data-fixed-price="{{ $each?->fixed_price }}">
                    </td>

                    <td>
                        {{ sprintf('Tk %s', number_format($each->purchase_price)) }}
                        <input type="radio" name="price" class="purchase-price-checkbox"
                            data-purchase-price="{{ $each?->purchase_price }}">
                    </td>

                    <td class="fw-500">{{ sprintf('Tk %s', number_format($each->price)) }}
                        <input type="radio" name="price" class="price-checkbox" data-price="{{ $each->price }}">
                    </td>

                    <td>
                        {{ sprintf('Tk %s', number_format($each?->additional_price)) }}
                        <input type="radio" name="price" class="additional-price-checkbox" data-additional-price="{{ $each->additional_price }}">
                    </td>
                    <td class="fw-500">{{ $each->registration }}</td>
                    <td class="fw-500">{{ $each->manufacture }}</td>
                    <td>{{ str(toCurrentStatus($each->status))->toHtmlString() }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('admin.vehicle.product.edit', ['product' => $each->id]) }}"
                                    class="dropdown-item text-danger">Edit</a>
                                <form action="{{ route('admin.vehicle.product.delete', ['product' => $each->id]) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="dropdown-item text-danger"
                                        onclick="deleteItem(this)">Trash</button>
                                </form>
                                <a href="{{ route('admin.vehicle.description.index', ['vehicle' => $each->id]) }}"
                                    class="dropdown-item">Detail</a>
                                <a href="{{ route('admin.vehicle.gallery.index', ['vehicle' => $each->id]) }}"
                                    class="dropdown-item">Gallery</a>
                            </div>
                        </div>
                    </td>
                    <td>{{ $each->updated_at->diffForHumans() }}</td>

                    <td>
                        @php
                            $arr = $each?->description->pluck('content');
                            $des = Arr::first($arr);
                        @endphp
                        <button class="send-whatsapp-button btn btn-sccess"
                            onclick="sendToWhatsApp('{{ toLocaleString($each?->translate) }}','{{ toLocaleString($each?->brand?->translate) }}','{{ toLocaleString($each?->edition?->translate) }}','{{ $each?->engines }}','{{ toLocaleString($each?->fuel?->translate) }}','{{ $each?->mileage }}','{{ $each->fixed_price }}', '{{ route('admin.VehicleWhatsApp', ['slug' => $each->slug]) }}')"><img
                                src="{{ asset('images/whatsapp.png') }}" alt="#" width="40px"></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Sl</th>
            <th>Title</th>
            <th>Brand</th>
            <th>Edition</th>
            <th>Condition</th>
            <th>Transmission</th>
            <th>Engine</th>
            <th>Fuel</th>
            <th>Skeleton</th>
            <th>Mileage</th>
            <th>Price</th>
            <th>Reg.</th>
            <th>Mfg.</th>
            <th>Status</th>
            <th>Action</th>
            <th>Modified</th>
        </tr>
    </tfoot>
</table>
