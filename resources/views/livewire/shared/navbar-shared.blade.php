<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container">
        <a class="navbar-brand p-0" href="{{ route('home.index') }}">
            <img src="{{ asset('assets/img/logo-3.png') }}" width="70px" alt="Pilot Bazar Brand Logo" />
        </a>

        <div class="mobile-merchant-login" style="margin-left: -30px">
            <a class="fw-500 fs-6 nav-link text-decoration-none" href="{{ route('merchant.login.create') }}">Importer Login</a>
        </div>

        {{-- <form class="d-flex p-0" action="{{ route('home.search') }}" method="GET" role="search" style="width:140px;margin-left: -10px">
            @csrf
            <input name="search" class="form-control me-2" type="search" value="{{ request('search') }}"
                placeholder="Search" aria-label="Search">
        </form> --}}

        <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll fw-500" style="--bs-scroll-height: 100px;">
                @foreach ($navigators as $item => $each)
                    <li class="nav-item">
                        <a class="nav-link {{ $item == 0 ? 'active' : '' }}" wire:key="navbar{{ $item }}"
                            aria-current="page"
                            href="{{ $each->link ? route($each->link) : 'javascript:;' }}">{{ $each->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="d-flex gap-3 align-items-center">
                @livewire('plugin.theme-plugin')
                @livewire('plugin.locale-plugin')
                {{-- <form class="d-flex" action="{{ route('home.search') }}" method="GET" role="search">
                    @csrf
                    <input name="search" class="form-control me-2" type="search" value="{{ request('search') }}"
                        placeholder="Search" aria-label="Search">
                </form> --}}
                <div class="dropdown text-end">
                    @if (
                        !empty(auth()->guard('client')->user()->id
                        ))
                        <a href="javascript:;" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                class="rounded-circle">
                            <span>{{ auth()->guard('client')->user()->name }}</span>
                        </a>
                    @else
                        <a href="javascript:;" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    @endif

                    <ul class="dropdown-menu dropdown-menu-end fs-14"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 34px);"
                        data-popper-placement="bottom-start">
                        <li>
                            <a class="dropdown-item" href="{{ route('client.login.create') }}">
                                @if (isset(auth()->guard('client')->user()->id))
                                    Dashboard
                                @else
                                    Sign In
                                @endif

                            </a>
                        </li>
                        <li>
                            @if (!isset(auth()->guard('client')->user()->id))
                                <a class="dropdown-item" href="{{ route('client.register.create') }}">Register</a>
                            @endif
                        </li>
                        @if (
                            !empty(auth()->guard('client')->user()->id
                            ))
                            <form method="POST" action="{{ route('client.logout') }}">
                                @csrf
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('client.logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out<i class="fa-solid fa-power-off fa-fw ms-auto text-body text-opacity-50"></i>
                                </a>
                            </form>
                        @endif

                    </ul>
                </div>

            </div>
        </div>

        <div class="row mobile-search-box mt-2 m-auto">
            <div class="col-lg-12">
                <form class="searchBox" action="{{ route('home.search') }}"
                    method="GET" role="search">
                    @csrf
                    <input name="search" class="form-control" type="search" value="{{ request('search') }}"
                        style="min-width: 300px;border-radius:20px" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>

    </div>
</nav>
