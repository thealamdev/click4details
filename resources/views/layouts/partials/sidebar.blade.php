<style>
    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-thumb {
        background: #e2e1e1;
        border-radius: 20px
    }
</style>
<div id="sidebar" class="app-sidebar">
    <div class="app-sidebar-content" style="overflow: auto">
        <div class="menu">
            @if (request()->routeIs('admin.*'))
                <div class="menu-header">Main Navigation</div>
                <div class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-apps fs-20"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>
                @if (auth()->user()->role == 'Admin')
                    <div class="menu-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="ti ti-stack-2 fs-20"></i></span>
                            <span class="menu-text">Categories</span>
                        </a>
                    </div>
                    <div class="menu-item {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.slider.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="ti ti-adjustments-horizontal fs-20"></i></span>
                            <span class="menu-text">Sliders</span>
                        </a>
                    </div>
                    <div class="menu-item {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.contact.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="ti ti-address-book fs-20"></i></span>
                            <span class="menu-text">Contacts</span>
                        </a>
                    </div>
                    <div class="menu-divider"></div>
                    <div class="menu-header">Profile Management</div>
                    <div class="menu-item {{ request()->routeIs('admin.client.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.client.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="ti ti-users fs-20"></i></span>
                            <span class="menu-text">Clients</span>
                        </a>
                    </div>
                    <div class="menu-item {{ request()->routeIs('admin.merchant.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.merchant.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="ti ti-brand-firebase fs-20"></i></span>
                            <span class="menu-text">Merchants</span>
                        </a>
                    </div>
                    <div class="menu-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.user.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="ti ti-user fs-20"></i></span>
                            <span class="menu-text">Admins</span>
                        </a>
                    </div>

                    <!-- Executives Reports start -->
                    <div class="menu-header">Executives Report</div>
                    <div class="menu-item has-sub expand">
                        <div class="menu-item {{ request()->routeIs('admin.vehicle.requirement.clients') || request()->routeIs('admin.vehicle.requirement.filterClient') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.requirement.clients') }}" class="menu-link">
                                <span class="menu-text">All Customers</span>
                            </a>
                        </div>
                    </div>
                    <!-- Executives Reports end -->
                @endif

                <!-- Customer Care Moderator can see start -->
                <div class="menu-header">Customer Care</div>
                <div class="menu-item has-sub expand">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-file"></i></span>
                        <span class="menu-text d-flex align-items-center">Messages</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: none; box-sizing: border-box;">
                        <div class="menu-item {{ request()->routeIs('admin.customer-care.followup-message.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.customer-care.followup-message.index') }}" class="menu-link">
                                <span class="menu-text">FollowUp</span>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.customer-care.followup-package.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.customer-care.followup-package.create') }}" class="menu-link">
                                <span class="menu-text">Package</span>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('admin.customer-care.followup-message-service.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.customer-care.followup-message-service.create') }}" class="menu-link">
                                <span class="menu-text">Message Service</span>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.customer-care.feedback-message.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.customer-care.feedback-message.index') }}" class="menu-link">
                                <span class="menu-text">Feedback</span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-item {{ request()->routeIs('admin.vehicle.requirement.index') || request()->routeIs('admin.vehicle.requirement.filter') ? 'active' : '' }}">
                        <a href="{{ route('admin.vehicle.requirement.index') }}" class="menu-link">
                            <span class="menu-text">Customers</span>
                        </a>
                    </div>

                    <div class="menu-item {{ request()->routeIs('admin.vehicle.requirement.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.vehicle.requirement.create') }}" class="menu-link">
                            <span class="menu-text">Customer Requirement</span>
                        </a>
                    </div>
                </div>
                <!-- Customer Care Moderator can see end -->

                <div class="menu-divider"></div>
                <div class="menu-header">Vehicle Management</div>
                <div class="menu-item has-sub expand">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Modules</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: none; box-sizing: border-box;">

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.brand.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.brand.index') }}" class="menu-link">
                                <div class="menu-text">Brands</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.model.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.model.index') }}" class="menu-link">
                                <div class="menu-text">Model</div>
                            </a>
                        </div>


                        <div class="menu-item {{ request()->routeIs('admin.vehicle.color.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.color.index') }}" class="menu-link">
                                <div class="menu-text">Color</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.available.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.available.index') }}" class="menu-link">
                                <div class="menu-text">Available</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.registration.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.registration.index') }}" class="menu-link">
                                <div class="menu-text">Registration</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.detail.*') || request()->routeIs('admin.vehicle.featur.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.detail.index') }}" class="menu-link">
                                <div class="menu-text">Feature & Details</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.edition.*') || request()->routeIs('admin.vehicle.package.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.edition.index') }}" class="menu-link">
                                <div class="menu-text">Edition & Package</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.condition.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.condition.index') }}" class="menu-link">
                                <div class="menu-text">Conditions</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.engine.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.engine.index') }}" class="menu-link">
                                <div class="menu-text">Engines</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.fuel.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.fuel.index') }}" class="menu-link">
                                <div class="menu-text">Fuels</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.skeleton.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.skeleton.index') }}" class="menu-link">
                                <div class="menu-text">Skeletons</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.mileage.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.mileage.index') }}" class="menu-link">
                                <div class="menu-text">Mileages</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.transmission.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.transmission.index') }}" class="menu-link">
                                <div class="menu-text">Transmissions</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.vehicle.grade.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.vehicle.grade.index') }}" class="menu-link">
                                <div class="menu-text">Grades</div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="menu-item {{ request()->routeIs('admin.vehicle.product.index') || request()->routeIs('admin.vehicle.requirement.search') ? 'active' : '' }}">
                    <a href="{{ route('admin.vehicle.product.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-car"></i></span>
                        <span class="menu-text">Vehicles</span>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('admin.vehicle.product.secure') ? 'active' : '' }}">
                    <a href="{{ route('admin.vehicle.product.secure') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-brand-volkswagen fs-20"></i></span>
                        <span class="menu-text">Secure Vehicles</span>
                    </a>
                </div>

                <div class="menu-divider"></div>
                <div class="menu-header">Residence Management</div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Modules</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: {{ request()->routeIs('admin.residence.completion-status.*') || request()->routeIs('admin.residence.furnished-status.*') || request()->routeIs('admin.residence.apartment-complex.*') ? 'block' : 'none' }}; box-sizing: border-box;">
                        <!-- sub menu goes here -->
                        <div class="menu-item {{ request()->routeIs('admin.residence.completion-status.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.residence.completion-status.index') }}" class="menu-link">
                                <div class="menu-text">Completion Status</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('admin.residence.furnished-status.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.residence.furnished-status.index') }}" class="menu-link">
                                <div class="menu-text">Furnished Status</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('admin.residence.apartment-complex.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.residence.apartment-complex.index') }}" class="menu-link">
                                <div class="menu-text">Apartment Complex</div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="menu-item {{ request()->routeIs('admin.residence.product.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.residence.product.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-home fs-20"></i></span>
                        <span class="menu-text">Residences</span>
                    </a>
                </div>

                <!-- Rental Service Start !-->
                <div class="menu-divider"></div>
                <div class="menu-header">Rental Services</div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Category</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: {{ request()->routeIs('admin.rental.category.*') ? 'block' : 'none' }}; box-sizing: border-box;">
                        <!-- sub menu goes here -->
                        <div class="menu-item {{ request()->routeIs('admin.rental.category.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.rental.category.index') }}" class="menu-link">
                                <div class="menu-text">Rental Category</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Services</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: {{ request()->routeIs('admin.rental.service.car.*') ? 'block' : 'none' }}; box-sizing: border-box;">
                        <!-- sub menu goes here -->
                        <div class="menu-item {{ request()->routeIs('admin.rental.service.car.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.rental.service.car.index') }}" class="menu-link">
                                <div class="menu-text">Rental Car</div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Rental Service End !-->

                <div class="menu-divider"></div>
                <div class="menu-header">Property Management</div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Modules</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: none; box-sizing: border-box;">
                        <!-- sub menu goes here -->
                        <div class="menu-item {{ request()->routeIs('admin.property.type.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.property.type.index') }}" class="menu-link">
                                <div class="menu-text">Land Type</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.property.size.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.property.size.index') }}" class="menu-link">
                                <div class="menu-text">Size Unit</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('admin.property.price.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.property.price.index') }}" class="menu-link">
                                <div class="menu-text">Price Unit</div>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="menu-item {{ request()->routeIs('admin.property.product.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.property.product.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-helicopter-landing fs-20"></i></span>
                        <span class="menu-text">Properties</span>
                    </a>
                </div>


                <div class="menu-divider"></div>
                <div class="menu-header">Accessories Management</div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Modules</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: none; box-sizing: border-box;">
                        <!-- sub menu goes here -->
                        <div class="menu-item {{ request()->routeIs('admin.accessory.shipping.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.accessory.shipping.index') }}" class="menu-link">
                                <div class="menu-text">Shipping</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('admin.accessory.brand.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.accessory.brand.create') }}" class="menu-link">
                                <div class="menu-text">Brand</div>
                            </a>
                        </div>
                    </div>

                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-cart-plus"></i></span>
                        <span class="menu-text d-flex align-items-center">Orders</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu" style="display: none; box-sizing: border-box;">
                        <!-- sub menu goes here -->
                        <div class="menu-item {{ request()->routeIs('admin.accessory.order.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.accessory.order.index') }}" class="menu-link">
                                <div class="menu-text">All Orders</div>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="menu-item {{ request()->routeIs('admin.accessory.product.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.accessory.product.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="fa-brands fa-product-hunt"></i></span>
                        <span class="menu-text">Accessories</span>
                    </a>
                </div>
            @elseif (request()->routeIs('merchant.*'))
                <div class="menu-header">Main Navigation</div>
                <div class="menu-item {{ request()->routeIs('merchant.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('merchant.dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-apps fs-20"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('merchant.vehicle.product.approvals') }}" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-car"></i></span>
                        <span class="menu-text">Approvals</span>
                    </a>
                </div>
                <!-- Customer Care part start !-->
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-users"></i></span>
                        <span class="menu-text d-flex align-items-center">Customer Care</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>

                    <div class="menu-submenu" style="display: none; box-sizing: border-box;">
                        <div class="menu-item {{ request()->routeIs('merchant.customer-care.index') ? 'active' : '' }}">
                            <a href="{{ route('merchant.customer-care.index') }}" class="menu-link">
                                <div class="menu-text">Lists</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('customer-care.register.create') ? 'active' : '' }}">
                            <a href="{{ route('customer-care.register.create') }}" class="menu-link">
                                <div class="menu-text">Create</div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Customer Care part end !-->

                <!-- Moduels part start !-->
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-carousel-horizontal fs-20"></i></span>
                        <span class="menu-text d-flex align-items-center">Modules</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>

                    <div class="menu-submenu" style="display: {{ request()->routeIs('merchant.vehicle.model.*') ? 'block' : 'none' }}; box-sizing: border-box;">
                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.brand.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.brand.index') }}" class="menu-link">
                                <div class="menu-text">Brands</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.model.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.model.index') }}" class="menu-link">
                                <div class="menu-text">Model</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.color.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.color.index') }}" class="menu-link">
                                <div class="menu-text">Color</div>
                            </a>
                        </div>

                        {{-- <div
                            class="menu-item {{ request()->routeIs('merchant.vehicle.availables.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.available.index') }}" class="menu-link">
                                <div class="menu-text">Available</div>
                            </a>
                        </div> --}}

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.registration.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.registration.index') }}" class="menu-link">
                                <div class="menu-text">Registration</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.edition.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.edition.index') }}" class="menu-link">
                                <div class="menu-text">Editions</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.condition.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.condition.index') }}" class="menu-link">
                                <div class="menu-text">Conditions</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.engine.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.engine.index') }}" class="menu-link">
                                <div class="menu-text">Engines</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.fuel.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.fuel.index') }}" class="menu-link">
                                <div class="menu-text">Fuels</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.skeleton.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.skeleton.index') }}" class="menu-link">
                                <div class="menu-text">Skeletons</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.mileage.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.mileage.index') }}" class="menu-link">
                                <div class="menu-text">Mileages</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.transmission.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.transmission.index') }}" class="menu-link">
                                <div class="menu-text">Transmissions</div>
                            </a>
                        </div>

                        <div class="menu-item {{ request()->routeIs('merchant.vehicle.grade.*') ? 'active' : '' }}">
                            <a href="{{ route('merchant.vehicle.grade.index') }}" class="menu-link">
                                <div class="menu-text">Grades</div>
                            </a>
                        </div>

                    </div>
                </div>
                <!-- Moduels part end !-->
                {{-- {{ route('merchant.vehicle.product.index') }} --}}
                <div class="menu-item">
                    <a href="{{ route('merchant.vehicle.purchase-price.create') }}" class="menu-link" id="purchaseBox">
                        <span class="menu-icon"><i class="fa-solid fa-car"></i></span>
                        <span class="menu-text">Vehicles</span>
                    </a>
                </div>
            @elseif (request()->routeIs('customer-care.*'))
                <div class="menu-item">
                    <a href="{{ route('customer-care.vehicle.product.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-apps fs-20"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item {{ request()->routeIs('customer-care.vehicle.product.index') ? 'active' : '' }}"">
                    <a href="{{ route('customer-care.vehicle.product.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-car"></i></span>
                        <span class="menu-text">Vehicles</span>
                    </a>
                </div>
                <div class="menu-item {{ request()->routeIs('customer-care.vehicle.product.largeView') ? 'active' : '' }}">
                    <a href="{{ route('customer-care.vehicle.product.largeView') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-apps fs-20"></i></span>
                        <span class="menu-text">Large View</span>
                    </a>
                </div>
            @elseif (request()->routeIs('client.*'))
                <div class="menu-header">Main Navigation</div>
                <div class="menu-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('client.dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-apps fs-20"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>
            @endif
            <div class="p-3 px-4 mt-auto hide-on-minified">
                {{-- <a href="//qubenext.com" class="btn btn-secondary d-block w-100 fw-600 rounded-pill" target="_blank">
                    <i class="fa-solid fa-code-commit me-2 ms-n1 opacity-5"></i>App Version 1.0.0
                </a> --}}
            </div>
        </div>
    </div>
    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
</div>
