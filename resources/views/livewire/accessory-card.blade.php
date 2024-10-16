<div class="container">

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <table class="table text-center w-100">
                        <thead>
                            <tr class="align-middle">
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (is_object($cards) && count($cards) > 0)

                                @foreach ($cards as $card)
                                    <tr class="align-middle">
                                        <td>
                                            <img src="{{ asset('storage/accessories/' . $card->image) }}" width="100px"
                                                height="60px" class="rounded" loading="lazy" alt="">
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $card?->title }}</p>
                                        </td>

                                        <td>
                                            <p class="mb-0">
                                                {{ 'Tk ' . number_format($card->unit_price * $card->quantity) }}</p>
                                        </td>

                                        <td>
                                            <button class="btn btn-dark border border-light"
                                                wire:click="decrement('{{ $card->id }}', '{{ $card->slug }}')">-</button>
                                            <span>{{ $card->quantity }}</span>
                                            <button class="btn btn-dark border border-light"
                                                wire:click="increment('{{ $card->id }}', '{{ $card->slug }}')">+</button>

                                        </td>


                                        <td>
                                            <i wire:click="delete('{{ $card->id }}')" class="fa-solid fa-trash"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <h2>No Data Found !!!</h2>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <p>Order Details</p>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @foreach ($cards as $card)
                                <tr>
                                    <td width="150px">{{ $card->title }}</td>
                                    <td>{{ $card->unit_price . '*' . $card->quantity }}</td>
                                    <td>{{ 'Tk ' . number_format($card->unit_price * $card->quantity) }}</td>
                                </tr>
                            @endforeach

                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                @php
                                    $sub_total = 0;
                                @endphp
                                <td>
                                    @foreach ($cards as $card)
                                        @php
                                            $sub_total += $card->unit_price * $card->quantity;
                                        @endphp
                                    @endforeach
                                    {{ 'TK ' . number_format($sub_total + ($shipping_details['charge'] ?? 0)) }}
                                </td>

                            </tr>
                        </tfoot>

                        <tfoot>
                            @if (!empty($shipping_details))
                                <tr>
                                    <td colspan="2">Shipping</td>
                                    @if (!empty($shipping_details))
                                        <td>{{ 'TK ' . $shipping_details['charge'] }}</td>
                                    @endif
                                </tr>
                            @endif
                        </tfoot>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @if (count($cards) > 0 && !isset($old_address))
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center toggle_div">
                        <h2>Shipping Address</h2>

                        <div class="view_icon">
                            <i class="fa-solid fa-angles-up"></i>

                        </div>
                    </div>

                    <div class="card-body" id="address_body">
                        <form wire:submit.prevent='store' accept-charset="utf-8" autocomplete="on"
                            class="need-validation" novalidate>
                            @csrf
                            <div class="row gx-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="f_name">Full Name<span
                                                class="ms-1 text-red-600">*</span></label>
                                        <input name="f_name" type="text"
                                            class="form-control @error('f_name') {{ 'is-invalid' }} @enderror"
                                            wire:model="f_name" placeholder="Input full name"
                                            value="{{ old('f_name') }}" required />
                                        @error('f_name')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="address">Address</label>
                                        <input type="text"
                                            class="form-control @error('address') {{ 'is-invalid' }} @enderror"
                                            name="address" wire:model="address"
                                            placeholder="House no./ building / street / area"
                                            value="{{ old('address') }}" required />
                                        @error('address')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="mobile">Mobile Number<span
                                                class="ms-1 text-red-600">*</span></label>
                                        <input type="number" name="mobile" wire:model="mobile"
                                            placeholder="Input mobile number"
                                            class="form-control @error('mobile') {{ 'is-invalid' }} @enderror"
                                            value="{{ old('mobile') }}" required />
                                        @error('mobile')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="divisions">District *<span
                                                class="ms-1 text-red-600">*</span></label>
                                        <select name="divisions" wire:model="divisions"
                                            class="form-select @error('divisions') {{ 'is-invalid' }} @enderror"
                                            wire:change="updateDistricts" required>
                                            <option value="" selected>Please Select...</option>
                                            @foreach ($all_districts as $each)
                                                <option value="{{ $each->id }}">
                                                    {{ $each->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('divisions')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}


                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="districts">District<span
                                                class="ms-1 text-red-600">*</span></label>
                                        <select name="districts" wire:model="districts" wire:change="updateUpazilas"
                                            class="form-select @error('districts') {{ 'is-invalid' }} @enderror"
                                            required>
                                            <option value="" selected>Please Select...</option>
                                            @foreach ($all_districts as $each)
                                                <option value="{{ $each->id }}">
                                                    {{ $each->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('districts')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="upazilas">Upazilas<span
                                                class="ms-1 text-red-600">*</span></label>
                                        <select name="upazilas" wire:model="upazilas"
                                            class="form-select @error('upazilas') {{ 'is-invalid' }} @enderror"
                                            required>
                                            <option value="" selected>Please Select...</option>
                                            @foreach ($all_upazilas as $each)
                                                <option value="{{ $each->id }}">
                                                    {{ $each->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('upazilas')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-500 mb-1" for="union">Union<span
                                                class="ms-1 text-red-600">*</span></label>
                                        <select name="unions" wire:model="unions"
                                            class="form-select @error('unions') {{ 'is-invalid' }} @enderror"
                                            required>
                                            <option value="" selected>Please Select...</option>
                                            @foreach ($all_unions as $each)
                                                <option value="{{ $each->id }}">
                                                    {{ $each->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unions')
                                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-dark border-0">
                                    <i class="fa-solid fa-plus me-1"></i>Confirm & Next
                                </button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="mt-3">
                <a href="{{ route('home.accessory') }}"><button class="btn btn-success">Select Product</button></a>
                @if (!empty($old_address) && count($cards))
                    <a href="{{ route('home.accessory-order') }}"><button class="btn btn-success">Next
                            Page</button></a>
                @endif
            </div>
        </div>
    </div>

</div>

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const icon = document.querySelector(".view_icon i");
            const toggle_div = document.querySelector(".toggle_div");
            const addressBody = document.getElementById("address_body");

            let isShown = false;

            toggle_div.addEventListener("click", function() {
                if (isShown) {
                    addressBody.style.display = "none";
                    icon.classList.remove("fa-angles-up");
                    icon.classList.add("fa-angles-down");
                } else {
                    addressBody.style.display = "block";
                    icon.classList.remove("fa-angles-down");
                    icon.classList.add("fa-angles-up");
                }
                isShown = !isShown;
            });
        });
    </script>
@endpush
