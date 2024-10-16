<div class="container">
    <div class="d-flex justify-content-center mb-2">
        <div class="container featured-container">
            <div class="featured-items">
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
                    @foreach ($collections as $item => $each)
                        <div class="col" wire:click="viewCount({{ $each->id }})">
                            <div class="card rounded shadow-sm border border-slate-200">
                                @if ($each->status !== 1)
                                    <h5 class="text-danger text-center pt-2">SOLD OUT</h5>
                                @endif
                                <a href="{{ route('home.flat-detail', ['slug' => $each?->slug]) }}" style="text-decoration: none;color: var(--bs-heading-color)">
                                    <div class="card-body p-2">
                                        <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}" class="card-img-top rounded" loading="lazy" alt="" />
                                        <h5 class="fs-16 fw-500 mt-2 mb-0">
                                            {{ toLocaleString($each?->translate, $translate) }}
                                        </h5>
                                        <p class="fs-12 d-flex gap-1 mb-1">
                                            <span>
                                                Bedrooms : {{ $each->bedrooms }}
                                            </span>
                                            <span>|</span>
                                            <span> Bathrooms : {{ $each->bathrooms }} </span>
                                        </p>

                                        <p class="fs-12 d-flex gap-1 mb-1">
                                            <span>
                                                {{ toLocaleString($each->completionStatus->translate, $translate) }}
                                            </span>
                                            <span>|</span>
                                            <span> {{ toLocaleString($each->furnishedStatus->translate, $translate) }} </span>
                                            <span>|</span>
                                            <span> {{ toLocaleString($each->apartmentComplex->translate, $translate) }} </span>
                                        </p>

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="card-text">
                                                @if ($each?->price > 0)
                                                    <h5 class="class="fs-16 fw-500 mt-2 mb-0"">
                                                        {{ __('module.datalist.TK', [], $translate) }}
                                                        {{ $each->price }} {{ $each?->unit_price }}
                                                    </h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
