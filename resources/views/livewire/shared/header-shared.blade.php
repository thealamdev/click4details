<div class="container my-3">
    <div class="text-center pb-1">
        <p><a style="font-size: 20px !important; text-decoration:none" href="tel:+8801969944400">Hotline : +8801969944400</p>
    </div>
    <div class="border border-slate-400 shadow-sm" style="border-radius: 10px;padding:10px;">
        <div class="row d-flex justify-content-center">
            @foreach ($categories as $item => $each)
                <div class="col-lg-2 col-md-3 col-3 text-center mt-1">
                    <a href="{{ $each->link ? route($each->link) : 'javascript:;' }}" style="border: 1px solid{{ $each?->id == session()->get('active') ? '#04ff00' : 'gray' }} !important" wire:key="category{{ $each->id }}" class="card p-1 rounded shadow-sm text-decoration-none category-list" wire:click.prevent="activeCategory({{ $each->id }})" onclick="event.preventDefault(); setTimeout(() => { window.location.href = '{{ $each->link ? route($each->link) : 'javascript:;' }}'; }, 100);">
                        <div class="header-item">
                            <div class="header-icon">
                                <i class="{{ $each->icon ?? 'fa-solid fa-display' }}" style="font-size: 10px"></i>
                            </div>
                            <div class="header-text">
                                <div class="fw-semibold">
                                    <p style="font-size: 10px" class="mb-0 p-0 text-body text-opacity-50">{{ toLocaleString($each->translate, $translate) }}</p>
                                </div>
                                {{-- @if ($each->slug == 'car')
                                    <div class="small text-body text-opacity-50">
                                        {{ $each->vehicles_count > 0 ? trans('module.shared.record', ['total' => toLocaleNumber($each->vehicles_count, $translate)], $translate) : trans('module.shared.coming', [], $translate) }}
                                    </div>
                                @endif

                                @if ($each->slug == 'land')
                                    <div class="small text-body text-opacity-50">
                                        {{ $each->property_count > 0 ? trans('module.shared.record', ['total' => toLocaleNumber($each->property_count, $translate)], $translate) : trans('module.shared.coming', [], $translate) }}
                                    </div>
                                @endif

                                @if ($each->slug == 'accessory')
                                    <div class="small text-body text-opacity-50">
                                        {{ $each->accessory_count > 0 ? trans('module.shared.record', ['total' => toLocaleNumber($each->accessory_count, $translate)], $translate) : trans('module.shared.coming', [], $translate) }}
                                    </div>
                                @endif

                                @if ($each->slug == 'rental-service')
                                    <div class="small text-body text-opacity-50">
                                        {{ count($rental_category) > 0 ? trans('module.shared.service', ['total' => toLocaleNumber(count($rental_category) > 0, $translate)], $translate) : trans('module.shared.coming', [], $translate) }}
                                    </div>
                                @endif

                                @if ($each->slug != 'car' and $each->slug != 'land' and $each->slug != 'accessory' and $each->slug != 'rental-service')
                                    <div class="small text-body text-opacity-50">
                                        {{ trans('module.shared.coming', [], $translate) }}
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
