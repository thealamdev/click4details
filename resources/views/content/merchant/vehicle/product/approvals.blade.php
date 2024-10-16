@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Products Pending List Manage</h4>
            <p class="mb-0">Manage all the vehicle pending products</p>
        </div>

    </div>



    <div class="card rounded border border-gray-300">
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="align-middle">Approval</th>
                        <th class="align-middle">Brand</th>
                        <th class="align-middle">Model</th>
                        <th class="align-middle">Mfg Yr</th>
                        <th class="align-middle">Reg Yr</th>
                        <th class="align-middle">Cond</th>
                        <th class="align-middle">Edi</th>
                        <th class="align-middle">Mileage</th>
                        <th class="align-middle">Features</th>
                        <th class="align-middle">Purchase Tk</th>
                        <th class="align-middle">Asking Tk</th>
                        <th class="align-middle">Fixed Tk</th>
                        <th class="align-middle">Chassis No.</th>
                        <th class="align-middle">Engine No.</th>
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
                                    <form action="{{ route('merchant.vehicle.product.approvalVehicle', ['vehicle' => $each->id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                                    </form>
                                </td>
                                <td class="fw-500">{{ toLocaleString($each?->brand?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->carmodel?->translate) }}</td>
                                <td class="fw-500">{{ $each->manufacture }}</td>
                                <td class="fw-500">{{ $each->registration }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->condition?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->edition?->translate) }}</td>
                                <td class="fw-500">{{ toLocaleString($each?->mileage?->translate) }}</td>
                                <td class="fw-500">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" title="Feature && Details" data-bs-target="#detailModal{{ $each->id }}">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </button>

                                    <div class="modal fade" id="detailModal{{ $each->id }}" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailLabel">Feature && Details of
                                                        {{ toLocaleString($each?->translate) }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ sprintf('Tk %s', number_format($each->fixed_price)) }}
                                </td>
                                <td class="fw-500">{{ sprintf('Tk %s', number_format($each->price)) }}
                                </td>
                                <td>
                                    {{ sprintf('Tk %s', number_format($each->purchase_price)) }}
                                </td>
                                <td class="fw-500">{{ $each?->chassis_number }}</td>
                                <td class="fw-500">{{ $each?->engine_number }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="javascript:;" data-bs-toggle="dropdown" class="text-body text-opacity-50" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('merchant.vehicle.product.edit', ['product' => $each->id]) }}" class="dropdown-item text-danger">Visit</a>
                                            <form action="{{ route('merchant.vehicle.product.delete', ['product' => $each->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item">Trash</button>
                                            </form>
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
@endpush
