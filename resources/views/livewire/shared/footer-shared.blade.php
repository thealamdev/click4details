<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-body-secondary">Copyright © {{ date('Y') }} {{ config('app.name') }} Limited | Beta Version 2.0</span>
        </div>
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            @foreach ($this->socials as $item => $each)
            <li class="ms-3">
                <a class="text-body-secondary" href="{{ $each->link }}" wire:key="social{{ $item }}">
                    <i class="{{ $each->icon }} fs-16"></i>
                </a>
            </li>
            @endforeach
        </ul>
    </footer>
</div>