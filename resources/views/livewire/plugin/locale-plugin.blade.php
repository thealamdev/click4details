<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://flagicons.lipis.dev/flags/4x3/{{ $flag }}.svg" class="img-fluid me-1" style="height: 16px; width: 20px;" />
        <span>{{ $lang }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        @foreach ($languages as $item => $each)
         
        <li class="fs-14">
            <button type="button" wire:click.prevent="changeLocal('{{ $each->abbr }}')" wire:key="lang{{ $item }}" class="dropdown-item d-flex align-items-center  {{ $each->abbr === $lang ? 'active' : '' }}" aria-pressed="{{ $each->abbr === $lang ? 'true' : 'false' }}">
                <img src="https://flagicons.lipis.dev/flags/4x3/{{ $each->flag }}.svg" class="img-fluid me-2" style="height: 16px; width: 20px;" />
                <span>{{ $each->name }}</span>
            </button>
        </li>
        @endforeach
    </ul>
</div>