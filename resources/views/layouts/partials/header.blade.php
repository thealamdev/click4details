@php
    use App\Models\User;
    use App\Models\Client;
    $unreadNotifications = Auth::user()
        ->unreadNotifications()
        ->latest()
        ->paginate(20);
@endphp

<div id="header" class="app-header">
    <div class="mobile-toggler">
        <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <div class="brand">
        <div class="desktop-toggler">
            <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
        <a href="javascript:;" class="brand-logo">
            <img src="{{ asset('assets/img/brand.png') }}" class="invert-dark" alt="" style="height:44px;" />
        </a>
    </div>
    <div class="menu">
        <form class="menu-search" method="GET" autocomplete="on">
            <div class="menu-search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <div class="menu-search-input">
                <input type="text" class="form-control" placeholder="Search menu...">
            </div>
        </form>
        <div class="menu-item dropdown">
            @if (request()->routeIs('admin.*'))
                <a href="javascript:;" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                    <div class="menu-icon"><i class="fa-solid fa-comment"></i></div>
                    <div class="menu-label">
                        @if (!empty($unreadNotifications))
                            {{ count($unreadNotifications->where('type', 'App\\Notifications\\CustomerRequirement')) }}
                        @endif
                    </div>
                </a>
            @endif
            <div class="dropdown-menu dropdown-menu-end dropdown-notification" style="max-height:100vh;overflow:scroll">
                <div class="d-flex justify-content-between pe-3">
                    <h6 class="dropdown-header text-body-emphasis mb-1">Notifications</h6>
                    <a href="{{ route('admin.vehicle.product.notificationRead') }}"><i class="fa-solid fa-book"></i></a>
                </div>

                @if (!empty($unreadNotifications))
                    @forelse ($unreadNotifications as $each)
                        @if ($each->type == 'App\\Notifications\\CustomerRequirement')
                            <div class="dropdown-notification-item {{ $each->read_at !== null ? 'bg-secondary' : '' }}">
                                <div class="dropdown-notification-icon">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </div>
                                <div class="dropdown-notification-info">
                                    <div class="title">
                                        @foreach ($each['data'] as $key => $vehicle)
                                            <a href="{{ route('home.detail', ['slug' => $vehicle['slug']]) }}"
                                                class="title" style="display: inline-block;text-decoration:none">
                                                <p>{{ $key + 1 }}</p>
                                                @php
                                                    $attributes = ['brand', 'carmodel', 'edition', 'skeleton', 'grade', 'fuel', 'registration', 'color', 'available', 'transmission', 'condition', 'mileage', 'engine'];
                                                @endphp

                                                @foreach ($attributes as $key => $attr)
                                                    @if (!empty($vehicle[$attr]))
                                                        @if ($attr !== 'mileage' && $attr !== 'engine' && !empty($vehicle[$attr]['translate'][0]['title']))
                                                            <div class="item">
                                                                <span>{{ ucwords($attr) }}: </span>
                                                                {{ $vehicle[$attr]['translate'][0]['title'] }}
                                                            </div>
                                                        @elseif ($attr == 'mileage' || $attr == 'engine')
                                                            <div class="item">
                                                                <span>{{ ucwords($attr) }}: </span>
                                                                {{ $vehicle[$attr] }}
                                                                <span>{{ $attr == 'mileage' ? 'Km' : 'cc' }}</span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </a>
                                            <hr>
                                        @endforeach
                                    </div>
                                    <div class="time">{{ $each->created_at->diffForHumans() }}</div>
                                </div>

                                <div class="dropdown-notification-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif

                <div class="p-2 text-center mb-n1">
                    <a href="javascript:;" class="text-body-emphasis text-opacity-50 text-decoration-none">End of
                        Notification
                    </a>
                </div>
            </div>

        </div>

        <div class="menu-item dropdown">
            @if (request()->routeIs('admin.*'))
                <a href="javascript:;" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                    <div class="menu-icon"><i class="fa-regular fa-bell nav-icon"></i></div>
                    <div class="menu-label">

                        @if (!empty($unreadNotifications) && count($unreadNotifications) < 20)
                            {{ count($unreadNotifications) }}
                        @else
                            20+
                        @endif
                    </div>
                </a>
            @endif
            <div class="dropdown-menu dropdown-menu-end dropdown-notification" id="notificationBox"
                style="max-height:100vh;overflow:scroll">
                <div class="d-flex justify-content-between pe-3">
                    <h6 class="dropdown-header text-body-emphasis mb-1">Notifications</h6>
                    <a href="{{ route('admin.vehicle.product.notificationRead') }}"><i
                            class="fa-solid fa-book"></i></a>
                </div>

                @if (!empty($unreadNotifications))
                    @forelse ($unreadNotifications as $each)
                        @php
                            if ($each->type == 'App\\Notifications\\VehicleNotification') {
                                $userName = User::where('id', $each['data']['user_id'])->first();
                            }
                        @endphp
                        @if ($each->type == 'App\\Notifications\\VehicleNotification')
                            <a href="{{ route('admin.vehicle.product.notification', $each->id) }}"
                                class="dropdown-notification-item {{ $each->read_at !== null ? 'bg-secondary' : '' }}">
                                <div class="dropdown-notification-icon">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </div>
                                <div class="dropdown-notification-info">
                                    <div class="title">
                                        A new Vehicle is Added by {{ $userName?->name }}
                                    </div>
                                    <div class="time">{{ $each->created_at->diffForHumans() }}</div>
                                </div>

                                <div class="dropdown-notification-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </a>
                        @endif

                        @if ($each->type == 'App\Notifications\AccessoryNotification')
                            <a href="{{ route('admin.vehicle.product.notification', $each->id) }}"
                                class="dropdown-notification-item {{ $each->read_at !== null ? 'bg-secondary' : '' }}">
                                <div class="dropdown-notification-icon">
                                    <i class="fa-solid fa-cart-plus text-success"></i>
                                </div>
                                <div class="dropdown-notification-info">
                                    <div class="title">
                                        A new Accessory Order is created.
                                    </div>
                                    <div class="time">{{ $each->created_at->diffForHumans() }}</div>
                                </div>

                                <div class="dropdown-notification-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </a>
                        @endif

                        @if ($each->type == 'App\Notifications\VehicleView')
                            @php
                                $client = Client::where('id', $each['data']['client_id'])->first();
                            @endphp

                            <a href="{{ route('admin.vehicle.product.notification', $each->id) }}"
                                class="dropdown-notification-item {{ $each->read_at !== null ? 'bg-secondary' : '' }}">
                                <div class="dropdown-notification-icon">
                                    <i class="fa-solid fa-car text-info"></i>
                                </div>
                                <div class="dropdown-notification-info">
                                    <div class="title">
                                        A User {{ $client?->name }} view your car.
                                    </div>
                                    <div class="time">{{ $each->created_at->diffForHumans() }}</div>
                                </div>

                                <div class="dropdown-notification-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>

                            </a>
                        @endif

                    @empty
                    @endforelse
                @endif

                <div class="p-2 text-center mb-n1">
                    <a href="javascript:;" class="text-body-emphasis text-opacity-50 text-decoration-none">End of
                        Notification
                    </a>
                </div>
            </div>

        </div>
        <div class="menu-item dropdown">
            <a href="javascript:;" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                @if (request()->routeIs('merchant.*'))
                    <div class="menu-img online">
                        <img src="{{ asset('storage/merchants/' .Auth()->guard('merchant')->user()?->merchantInfo?->image?->name) }}"
                            alt="" class="ms-100 mh-100 rounded-circle" />
                    </div>
                @endif

                @if (request()->routeIs('customer-care.*'))
                    <div class="menu-img online">
                        <div class="menu-img online">
                            <img src="https://i.pravatar.cc/300" alt=""
                                class="ms-100 mh-100 rounded-circle" />
                        </div>
                    </div>
                @endif

                @if (request()->routeIs('admin.*'))
                    <div class="menu-img online">
                        <img src="https://i.pravatar.cc/300" alt="" class="ms-100 mh-100 rounded-circle" />
                    </div>
                @endif

                <div class="menu-text">
                    <p class="m-0">{{ auth()->user()?->name }}</p>
                    <p class="m-0 fw-400">{{ auth()->user()?->email }}</p>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-lg-3">
                @if (request()->routeIs('merchant.*'))
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ route('merchant.merchant.show', ['merchant' => auth()->user()?->id]) }}">
                        My Profile<i class="fa-regular fa-circle-user fa-fw ms-auto text-body text-opacity-50"></i>
                    </a>
                @endif

                @if (request()->routeIs('customer-care.*'))
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ route('merchant.merchant.show', ['merchant' => auth()->user()?->id]) }}">
                        My Profile<i class="fa-regular fa-circle-user fa-fw ms-auto text-body text-opacity-50"></i>
                    </a>
                @endif

                @if (request()->routeIs('admin.*'))
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ route('admin.user.show', ['user' => auth()->user()?->id]) }}">
                        Edit Profile<i class="fa-regular fa-circle-user fa-fw ms-auto text-body text-opacity-50"></i>
                    </a>
                @endif


                {{-- <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                    Edit Profile<i class="fa-regular fa-circle-user fa-fw ms-auto text-body text-opacity-50"></i>
                </a> --}}
                <div class="dropdown-divider"></div>
                @if (request()->routeIs('admin.*'))
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                        Inbox<i class="fa-regular fa-envelope fa-fw ms-auto text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                        Calendar<i class="fa-regular fa-calendar-days fa-fw ms-auto text-body text-opacity-50"></i>
                    </a>
                    <hr>
                    <a class="dropdown-item d-flex align-items-center" href="{{route('admin.setting.media.image-dimentin.index')}}">
                        Setting<i class="fa-solid fa-wrench fa-fw ms-auto text-body text-opacity-50"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out<i class="fa-solid fa-power-off fa-fw ms-auto text-body text-opacity-50"></i>
                        </a>
                    </form>
                @elseif (request()->routeIs('merchant.*'))
                    <form method="POST" action="{{ route('merchant.logout') }}">
                        @csrf
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('merchant.logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out<i class="fa-solid fa-power-off fa-fw ms-auto text-body text-opacity-50"></i>
                        </a>
                    </form>
                @elseif (request()->routeIs('customer-care.*'))
                    <form method="POST" action="{{ route('customer-care.logout') }}">
                        @csrf
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('customer-care.logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out<i class="fa-solid fa-power-off fa-fw ms-auto text-body text-opacity-50"></i>
                        </a>
                    </form>
                @elseif (request()->routeIs('client.*'))
                    <form method="POST" action="{{ route('client.logout') }}">
                        @csrf
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('client.logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out<i class="fa-solid fa-power-off fa-fw ms-auto text-body text-opacity-50"></i>
                        </a>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    let notificationBox = document.getElementById('notificationBox');

    notificationBox.addEventListener('scroll', function() {
        let scrollTopPosition = notificationBox.scrollTop;
        console.log(scrollTopPosition);
    });
</script>
