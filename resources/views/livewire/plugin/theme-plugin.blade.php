<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="{{ $icon }} me-1"></i>{{ $base }}
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        @foreach ($themes as $item => $each)
        <li class="fs-14">
            <button type="button" wire:click.prevent="changeColor('{{ $item }}')" wire:key="color{{ $item }}" class="dropdown-item d-flex align-items-center {{ $item === $base ? 'active' : '' }}" data-bs-theme-value="{{ $item }}" aria-pressed="{{ $item === $base ? 'true' : 'false' }}">
                <i class="{{ $each->icon }} me-1"></i>{{ $each->name }}
            </button>
        </li>
        @endforeach
    </ul>
</div>