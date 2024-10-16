<table class="table table-striped" style="width:100%;">
    <thead>
        <tr>
            <th class="align-middle">SL</th>
            <th class="align-middle">Date</th>
            <th class="align-middle">Executive</th>
            <th class="align-middle">Brand</th>
            <th class="align-middle">Model</th>
            <th class="align-middle">Model Year</th>
            <th class="align-middle">Edition</th>
            <th class="align-middle">Mileage</th>
            <th class="align-middle">Condition</th>
            <th class="align-middle">Fuel</th>
            <th class="align-middle">Registration</th>
            <th class="align-middle">Grade</th>
            <th class="align-middle">Color</th>
            <th class="align-middle">Name</th>
            <th class="align-middle">Mobile</th>
            <th class="align-middle">Level</th>
            <th class="align-middle">Seriousness</th>
            <th class="align-middle">Frequncy Car Change(yearly)</th>
            <th class="align-middle">Profession</th>
            <th class="align-middle">Budget</th>
            {{-- <th class="align-middle">Modified</th> --}}
        </tr>
    </thead>

    <tbody>

        @if (is_object($requirements) && $requirements->count() > 0)
            @foreach ($requirements as $n => $each)
                <tr data-bs-toggle="modal" data-bs-target=".detail{{ $each?->id }}">
                    {{-- <td class="fw-500 text-center">{{ str()->padLeft(++$n, 2, '0') }}</td> --}}
                    <td class="fw-500 text-center">{{ $each?->id }}</td>
                    <td class="fw-500 text-center">
                        {{ \Carbon\Carbon::parse($each->created_at)->format('d M, Y') }}
                    </td>
                    <td class="fw-500 text-center">{{ $each?->users?->name }}</td>

                    <td class="fw-500">
                        @foreach ($each?->brandCustomer as $brand)
                            <p>{{ $brand->brand }}</p>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->carmodelCustomer as $model)
                            <p>{{ $model->model }}</p>
                        @endforeach
                    </td class="fw-500">

                    <td class="fw-500">
                        @foreach ($each?->customerManufacture as $manufacture)
                            <p>{{ $manufacture->manufacture }}</p>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerEdition as $edition)
                            <p>{{ $edition->edition }}</p>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerMileage as $mileage)
                            {{ $mileage->mileage_start }} <span> Km to </span> {{ $mileage->mileage_end }}
                            <span>Km</span>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->conditionCustomer as $condition)
                            <P>{{ $condition?->condition }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerFuel as $fuel)
                            <P>{{ $fuel?->fuel }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerRegistration as $reg)
                            <P>{{ $reg?->registration }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerGrade as $grade)
                            <P>{{ $grade?->grade }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->colorCustomer as $color)
                            <P>{{ $color?->color }}</P>
                        @endforeach
                    </td>

                    <td>
                        <div class="list-group-item list-group-item-action d-flex align-items-center text-body">
                            <div class="flex-fill">
                                <div class="fw-semibold">{{ $each?->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="fw-500">{{ $each?->mobile ?? '--' }}</td>
                    <td class="fw-500">{{ strtoupper($each?->level) }}</td>
                    <td class="fw-500">
                        @if (!empty($each?->serious))
                            {{ $each?->serious ?? '--' }} %
                        @else
                            --
                        @endif
                    </td>


                    <td class="fw-500">
                        @if (!empty($each?->frequency))
                            {{ $each?->frequency }}
                            {{ $each?->frequency > 1 ? " Car's in year" : 'Car in year' }}
                        @else
                            --
                        @endif
                    </td>
                    <td class="fw-500">{{ $each?->profession ?? '--' }}</td>

                    <td class="fw-500">
                        @if (isset($each) && isset($each->budget_from) && isset($each->budget_to))
                            {{ $each->budget_from . ' to ' . $each->budget_to }} {{ 'lakh' }}
                        @else
                            --
                        @endif
                    </td>
                    {{-- <td>{{ $each->updated_at->diffForHumans() }}</td> --}}
                </tr>

                <!-- detail modal !-->
                @include('content.package.vehicle.requirement.partials.clients.modal')
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Executive</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Model Year</th>
            <th>Edition</th>
            <th>Mileage</th>
            <th>Condition</th>
            <th>Fuel</th>
            <th>Registration</th>
            <th>Grade</th>
            <th>Color</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Level</th>
            <th>Seriousness</th>
            <th>Frequncy Car Change(yearly)</th>
            <th>Profession</th>
            <th>Budget</th>
            {{-- <th>Modified</th> --}}
        </tr>
    </tfoot>
</table>
