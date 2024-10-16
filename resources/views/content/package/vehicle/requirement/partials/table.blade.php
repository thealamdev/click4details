<table class="table table table-striped" style="width:100%;">
    <thead class="bg-slate-700 text-slate-300">
        <tr>
            <th class="align-middle">Seriousness</th>
            <th class="align-middle">SL</th>
            <th class="align-middle">Date</th>
            <th class="align-middle">Handover</th>
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
            <th class="align-middle">Detail</th>
            <th class="align-middle">Name</th>
            <th class="align-middle">Mobile</th>
            <th class="align-middle">Level</th>
            <th class="align-middle">Frequncy Car Change(yearly)</th>
            <th class="align-middle">Profession</th>
            <th class="align-middle">Budget</th>
        </tr>
    </thead>

    <tbody>
        @if (is_object($requirements) && $requirements->count() > 0)
            @foreach ($requirements as $n => $each)
                <tr>
                    <td>
                        @php
                            $color = match (true) {
                                $each?->serious >= 90 => '#015e01',
                                $each?->serious >= 80 => '#036d03',
                                $each?->serious >= 70 => '#1bac1b',
                                $each?->serious >= 60 => '#06D001',
                                $each?->serious >= 50 => '#3aee3a',
                                $each?->serious >= 40 => '#9BEC00',
                                $each?->serious >= 30 => '#e44236',
                                $each?->serious >= 20 => '#e62518',
                                $each?->serious >= 10 => '#fa1100',
                                default => '#ff0000',
                            };
                        @endphp
                        <div style="width:15px;height:50px;border:1px solid #fff;position: relative;">
                            <p style="position: absolute;left:10%;top:-2px;z-index:100;" class="fw-500">{{ $each->serious . '%' }} </p>
                            <div class="text-center" style="position:absolute;bottom:0!important; clip-path: polygon(51% 0, 100% 30%, 100% 100%, 0 100%, 0 31%);width: 13px; height: {{ $each?->serious / 2 ?? 0 }}px; background: {{ $color }};">

                            </div>
                        </div>

                    </td>
                    <td class="fw-500 text-center" style="color: {{ $color }}">{{ $each?->id }}</td>
                    <td class="fw-500 text-center">
                        {{ \Carbon\Carbon::parse($each->created_at)->format('d M, Y') }}
                    </td>
                    <td>
                        <form action="{{ route('admin.vehicle.requirement.handover', ['requirement' => $each->id]) }}" method="POST" class="text-center">
                            @method('PUT')
                            @csrf
                            <select name="user_id" class="form-control bg-transparent" required>
                                <option selected disabled>Handover to</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user?->id }}">{{ $user?->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger fs-6">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="border border-slate-400 bg-transparent rounded mt-2 fs-6">OK</button>
                        </form>
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->brandCustomer as $brand)
                            <p>{{ $brand?->brand ?? '--' }}</p>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->carmodelCustomer as $model)
                            <p>{{ $model?->model ?? '--' }}</p>
                        @endforeach
                    </td class="fw-500">

                    <td class="fw-500">
                        @foreach ($each?->customerManufacture as $manufacture)
                            <p>{{ $manufacture?->manufacture ?? '--' }}</p>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerEdition as $edition)
                            <p>{{ $edition?->edition ?? '--' }}</p>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerMileage as $mileage)
                            {{ $mileage?->mileage_start ?? '--' }} <span> Km to </span>
                            {{ $mileage?->mileage_end ?? '--' }}
                            <span>Km</span>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->conditionCustomer as $condition)
                            <P>{{ $condition?->condition ?? '--' }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerFuel as $fuel)
                            <P>{{ $fuel?->fuel ?? '--' }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerRegistration as $reg)
                            <P>{{ $reg?->registration ?? '--' }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->customerGrade as $grade)
                            <P>{{ $grade?->grade ?? '--' }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        @foreach ($each?->colorCustomer as $color)
                            <P>{{ $color?->color ?? '--' }}</P>
                        @endforeach
                    </td>

                    <td class="fw-500">
                        <div class="btn-group">
                            <a class="border border-slate-400 bg-transparent rounded p-1" href="{{ route('admin.vehicle.requirement.edit', ['requirement' => $each?->id]) }}">
                                <i class="fa-solid fa-pen-to-square fs-6 text-black-900"></i>
                            </a>
                            <span>
                                <button type="button" class="border border-slate-400 bg-transparent rounded p-1" data-bs-toggle="modal" data-bs-target=".detail{{ $each?->id }}" data-bs-target="#staticBackdrop"><i class="fa-solid fa-circle-info"></i>
                                </button>
                            </span>
                        </div>
                    </td>

                    <td>
                        <div class="list-group-item list-group-item-action d-flex align-items-center text-body">
                            <div class="flex-fill">
                                <div class="fw-semibold">{{ $each?->name ?? '--' }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="fw-500">{{ $each?->mobile ?? '--' }}</td>
                    <td class="fw-500">{{ strtoupper($each?->level) ?? '--' }}</td>

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
                </tr>

                <!-- detail modal !-->
                @include('content.package.vehicle.requirement.partials.modal')
            @endforeach
        @endif
    </tbody>

    <tfoot class="bg-slate-700 text-slate-300">
        <tr>
            <th>Seriousness</th>
            <th>Sl</th>
            <th>Date</th>
            <th>Handover</th>
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
            <th>Detail</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Level</th>
            <th>Frequncy Car Change(yearly)</th>
            <th>Profession</th>
            <th>Budget</th>
        </tr>
    </tfoot>
</table>

@if (method_exists($requirements, 'links'))
    {{ $requirements->links() }}
@endif
