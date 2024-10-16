@extends('layouts.master')
@section('title', 'Merchant Profile')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Merchant Profile</h4>
                <p>Get all the profile details including activities and others event</p>
            </div>

            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Change Password
                </button>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{ route('merchant.merchant.changePassword', ['merchant' => $merchant->id]) }}"
                                    method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="mt-3">
                                        <label for="old_password">Old Password</label> <span class="text-danger">*</span>
                                        <input type="password" name="old_password" class="form-control"
                                            placeholder="Enter Old Password">
                                    </div>

                                    <div class="mt-3">
                                        <label for="password">New Password</label> <span class="text-danger">*</span>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter New Password">
                                        <div class="error text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label for="password_confirmation">Confirm Password</label> <span
                                            class="text-danger">*</span>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirm New Password">
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-secondary" type="submit">Confirm</button>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card p-4">
                    <div class="profile-main d-flex w-100 justify-content-between">
                        <div class="profile-image" style="width:15%">
                            <img src="{{ asset('storage/merchants/' . $merchant->merchantInfo?->image?->name) }}"
                                alt="" class="rounded-2" style="width:100%">
                        </div>

                        <div class="profile-detail" style="width:80%">
                            <div class="profile-name d-flex justify-content-between">
                                <div class="profile-left d-flex align-item-center">
                                    <h4 class="text-hover-primary d-inline-block ">
                                        {{ $merchant->merchantInfo?->company_name }}
                                    </h4>
                                    <span style="margin-top:-1px !important; padding-left:1px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                fill="#00A3FF"></path>
                                            <path class="permanent"
                                                d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                fill="white"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="profile-info">
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">

                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                    fill="currentColor">
                                                </path>

                                                <path
                                                    d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                    fill="currentColor">
                                                </path>
                                            </svg>
                                        </span>

                                        @if (request()->routeIs('admin.*'))
                                            Admin
                                        @else
                                            Merchant
                                        @endif

                                    </a>
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">

                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                    fill="currentColor">
                                                </path>
                                                <path
                                                    d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                    fill="currentColor">
                                                </path>
                                            </svg>
                                        </span>
                                        {{ $merchant->merchantInfo?->address }}
                                    </a>
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">

                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{ $merchant?->email }}
                                    </a>
                                </div>
                            </div>

                            <div class="profile-management">
                                <div class="d-flex flex-wrap justify-content-between w-50">

                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                        <div class="d-flex align-items-center">

                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="13" y="6" width="13" height="2"
                                                        rx="1" transform="rotate(90 13 6)" fill="currentColor">
                                                    </rect>
                                                    <path
                                                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>

                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                                data-kt-countup-value="4500" data-kt-countup-prefix="$">
                                                {{ count($merchant->vehicle) }}</div>
                                        </div>

                                        <div class="fw-bold fs-6 text-gray-400">Total Vehicles</div>

                                    </div>

                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="11" y="18" width="13" height="2"
                                                        rx="1" transform="rotate(-90 11 18)" fill="currentColor">
                                                    </rect>
                                                    <path
                                                        d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>

                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                                data-kt-countup-value="75">
                                                {{ implode(', ', array_unique(explode(', ', $merchant->code->pluck('prefix')->implode(', ')))) }}
                                            </div>
                                        </div>
                                        <div class="fw-bold fs-6 text-gray-400">Code Prefix</div>
                                    </div>

                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="13" y="6" width="13" height="2"
                                                        rx="1" transform="rotate(90 13 6)" fill="currentColor">
                                                    </rect>
                                                    <path
                                                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                                data-kt-countup-value="60" data-kt-countup-prefix="%">
                                                {{ count($merchant->code->pluck('code')->toArray()) }}</div>
                                        </div>
                                        <div class="fw-bold fs-6 text-gray-400">Total Codes</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">

                    <div class="card-header cursor-pointer d-flex justify-content-between">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Profile Details</h3>
                        </div>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#profileEditModal">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <div class="modal fade" id="profileEditModal" tabindex="-1"
                            aria-labelledby="profileEditModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="profileEditModalLabel">Profile Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('merchant.merchantInfo.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="mt-3">
                                                <label for="name">Name</label> <span class="text-danger">*</span>
                                                <input type="text" name="name"
                                                    value="{{ old('name', $merchant?->name) }}" class="form-control"
                                                    placeholder="Enter Your Name">
                                            </div>

                                            <div class="mt-3">
                                                <label for="company_name[en]">Company Name</label> <span
                                                    class="text-danger"></span>
                                                <input type="text" name="company_name[en]" class="form-control"
                                                    value="{{ old('company_name.en', $merchant->merchantInfo?->company_name) }}"
                                                    placeholder="Enter Your Company Name">
                                                <div class="error text-danger">
                                                    @error('company_name.en')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="company_name[bn]">Confirm Company Name(Retype this)</label>
                                                <span class="text-danger"></span>
                                                <input type="text" name="company_name[bn]" class="form-control"
                                                    value="{{ old('company_name.bn', $merchant->merchantInfo?->company_name) }}"
                                                    placeholder="Enter Your Company Name">
                                                <div class="error text-danger">
                                                    @error('company_name.bn')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="email">Email</label> <span class="text-danger">*</span>
                                                <input type="email" name="email"
                                                    value="{{ old('email', $merchant?->email) }}" class="form-control"
                                                    placeholder="Enter Company Email">
                                                <div class="error text-danger">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="phone">Enter Company Mobile</label> <span
                                                    class="text-danger">*</span>
                                                <input type="number" value="{{ old('mobile', $merchant?->mobile) }}"
                                                    name="mobile" class="form-control"
                                                    placeholder="Enter Company Phone">
                                                <div class="error text-danger">
                                                    @error('mobile')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="location">Enter Company Location(Country)</label> <span
                                                    class="text-danger"></span>
                                                <input type="text" name="location" class="form-control"
                                                    value="{{ old('location', $merchant->merchantInfo?->location) }}"
                                                    placeholder="Enter Company Location">
                                                <div class="error text-danger">
                                                    @error('location')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="website">Website Address</label> <span
                                                    class="text-danger"></span>
                                                <input type="text" name="website" class="form-control"
                                                    value="{{ old('website', $merchant->merchantInfo?->website) }}"
                                                    placeholder="Enter Company Website">
                                                <div class="error text-danger">
                                                    @error('website')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="facebook">Facebook Page</label> <span
                                                    class="text-danger"></span>
                                                <input type="text" name="facebook" class="form-control"
                                                    value="{{ old('facebook', $merchant->merchantInfo?->facebook) }}"
                                                    placeholder="Enter Company facebook page">
                                                <div class="error text-danger">
                                                    @error('facebook')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="youtube">Youtube Address</label> <span
                                                    class="text-danger"></span>
                                                <input type="text" name="youtube" class="form-control"
                                                    value="{{ old('youtube', $merchant->merchantInfo?->youtube) }}"
                                                    placeholder="Enter Company youtube link">
                                                <div class="error text-danger">
                                                    @error('youtube')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <input type="hidden" value="{{ $merchant->merchantInfo?->image?->id }}"
                                                name="image_id">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-500 mb-1" for="image">Company
                                                        Logo</label>
                                                    <input type="file" name="image"
                                                        class="form-control dropify @error('image') {{ 'is-invalid' }} @enderror"
                                                        data-max-file-size="3M" accept=".png, .jpg, .jpeg"
                                                        data-allowed-file-extensions="jpg png jpeg" />
                                                    @error('image')
                                                        <div class="text-red-600">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label for="address">Specific Location</label> <span class="text-danger">
                                                </span>

                                                <textarea id="markdown1" class="form-control" name="address" cols="30" rows="3"
                                                    placeholder="Enter Company Specific Location(Area, Road)">{{ old('address', $merchant->merchantInfo?->address) }}</textarea>
                                                <div class="error text-danger">
                                                    @error('address')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button class="btn btn-secondary" type="submit">Confirm</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-9">
                        <div class="row mb-1">
                            <label class="col-lg-4 fs-5 text-muted">Full Name</label>

                            <div class="col-lg-8">
                                <span class="fw-bold fs-5">{{ $merchant->name }}</span>
                            </div>
                        </div>

                        @if ($merchant->merchantInfo?->company_name)
                            <div class="row mb-1">
                                <label class="col-lg-4 fs-5 text-muted">Company</label>

                                <div class="col-lg-8 fv-row">
                                    <span class="fw-bold fs-5">{{ $merchant->merchantInfo?->company_name }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="row mb-1">
                            <label class="col-lg-4 fs-5 text-muted">Contact Phone
                                <i class="fas fa-exclamation-circle ms-1 fs-5" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Phone number must be active"
                                    aria-label="Phone number must be active"></i></label>

                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bold fs-5">{{ $merchant->mobile }}</span>
                                @if ($merchant->mobile_verified_at !== null)
                                    <span class="badge rounded-pill bg-success">Verified</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Unverified</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-lg-4 fs-5 text-muted">Email
                                <i class="fas fa-exclamation-circle ms-1 fs-5" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Email must be active"
                                    aria-label="Email must be active"></i></label>

                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bold fs-5">{{ $merchant->email }}</span>
                                @if ($merchant->email_verified_at !== null)
                                    <span class="badge rounded-pill bg-success">Verified</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Unverified</span>
                                @endif

                            </div>
                        </div>

                        @if ($merchant->merchantInfo?->website)
                            <div class="row mb-1">
                                <label class="col-lg-4 fs-5 text-muted">Website</label>

                                <div class="col-lg-8">
                                    <a href="{{ $merchant->merchantInfo?->website }}" target="_blank"
                                        class="fw-bold fs-5">{{ $merchant->merchantInfo?->website }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($merchant->merchantInfo?->facebook)
                            <div class="row mb-1">
                                <label class="col-lg-4 fs-5 text-muted">Facebook Page</label>

                                <div class="col-lg-8">
                                    <a href="{{ $merchant->merchantInfo?->facebook }}" target="_blank"
                                        class="fw-bold fs-5">{{ $merchant->merchantInfo?->facebook }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($merchant->merchantInfo?->youtube)
                            <div class="row mb-1">
                                <label class="col-lg-4 fs-5 text-muted">Youtube</label>

                                <div class="col-lg-8">
                                    <a href="{{ $merchant->merchantInfo?->youtube }}" target="_blank"
                                        class="fw-bold fs-5">{{ $merchant?->merchantInfo?->youtube }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($merchant->merchantInfo?->location)
                            <div class="row mb-1">
                                <label class="col-lg-4 fs-5 text-muted">Country
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="" data-bs-original-title="Country of origination"
                                        aria-label="Country of origination"></i></label>

                                <div class="col-lg-8">
                                    <span class="fw-bold fs-5">{{ $merchant->merchantInfo?->location }}</span>
                                </div>

                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            uploadsDragDrop()
            mdeMarkdownEditor('markdown1')
        })
    </script>
@endpush
