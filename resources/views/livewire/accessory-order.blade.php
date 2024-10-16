<div class="container">
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-header">
                    <h5>Order Details</h5>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @foreach ($order_details as $each)
                                <tr>
                                    <td width="150px">{{ $each->title }}</td>
                                    <td>{{ $each->unit_price . '*' . $each->quantity }}</td>
                                    <td>{{ 'Tk ' . number_format($each->unit_price * $each->quantity) }}</td>
                                </tr>
                            @endforeach

                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                @php
                                    $sub_total = 0;
                                @endphp
                                <td>
                                    @foreach ($order_details as $each)
                                        @php
                                            $sub_total += $each->unit_price * $each->quantity;
                                        @endphp
                                    @endforeach
                                    {{ 'TK ' . number_format($sub_total + ($shipping_details->district->charge ?? 0)) }}
                                </td>

                            </tr>
                        </tfoot>

                        <tfoot>
                            <tr>
                                <td colspan="2">Shipping</td>
                                @if (!empty($shipping_details))
                                    <td>{{ 'TK ' . $shipping_details->district->charge }}</td>
                                @else
                                    <td>{{ '--' }}</td>
                                @endif
                            </tr>
                        </tfoot>

                        </thead>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Shipping Details</h5>
                    <div class="shipping_edit">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Full Name</td>
                            <td>:</td>
                            <td>{{ $shipping_details->f_name }}</td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ $shipping_details->address }}</td>
                        </tr>

                        <tr>
                            <td>District</td>
                            <td>:</td>
                            <td>{{ $shipping_details->district->name }}</td>
                        </tr>

                        <tr>
                            <td>Upazila</td>
                            <td>:</td>
                            <td>{{ $shipping_details->upazila->name }}</td>
                        </tr>

                        <tr>
                            <td>Union</td>
                            <td>:</td>
                            <td>{{ $shipping_details->union->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (count($order_details) > 0)
        <div class="row mt-4">
            {{-- @if ($sub_total + $shipping_details->division->charge > 5000)
            <button class="btn btn-primary">Process to Checkout</button>
            @else --}}
            <button class="btn btn-success" wire:click="order" {{ $flag == 1 ? 'disabled' : '' }}>Order Now</button>
            {{-- @endif --}}
        </div>
    @else
        <a href="{{ route('home.accessory') }}"><button class="btn btn-success">Please select product to buy </button>
        </a>
    @endif


    <!-- Shipping address edit modal -->
    <div class="modal fade" wire:ignore.self id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Shipping Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <form wire:submit.prevent='update' accept-charset="utf-8" autocomplete="on" class="need-validation"
                        novalidate>
                        @csrf
                        <div class="row gx-3">
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="f_name">Full Name<span
                                            class="ms-1 text-red-600">*</span></label>
                                    <input name="f_name" type="text"
                                        class="form-control @error('f_name') {{ 'is-invalid' }} @enderror"
                                        wire:model="f_name" placeholder="Input full name" 
                                        required />
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
                                        required />
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
                                        required />
                                    @error('mobile')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="district">District<span
                                            class="ms-1 text-red-600">*</span></label>
                                    <select name="district" wire:model="district" wire:change="updateDistricts"
                                        class="form-select @error('district') {{ 'is-invalid' }} @enderror"
                                        required>
                                        <option value="" selected>Please Select...</option>
                                        @foreach ($districts as $each)
                                            <option value="{{ $each->id }}" @selected(old('district') == $each->id)>
                                                {{ $each->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="upazila">Upazila<span
                                            class="ms-1 text-red-600">*</span></label>
                                    <select name="upazilas" wire:model="upazila"
                                        class="form-select @error('upazila') {{ 'is-invalid' }} @enderror" required>
                                        <option value="" selected>Please Select...</option>
                                        @foreach ($upazilas as $each)
                                            <option value="{{ $each->id }}">
                                                {{ $each->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('upazila')
                                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-500 mb-1" for="union">Union<span
                                            class="ms-1 text-red-600">*</span></label>
                                    <select name="union" wire:model="union"
                                        class="form-select @error('union') {{ 'is-invalid' }} @enderror" required>
                                        <option value="" selected>Please Select...</option>
                                        @foreach ($unions as $each)
                                            <option value="{{ $each->id }}" @selected(old('union') == $each->id)>
                                                {{ $each->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('union')
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

                        {{-- @php
                            print_r($stock);
                        @endphp --}}

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                </div>
            </div>
        </div>
    </div>

</div>
