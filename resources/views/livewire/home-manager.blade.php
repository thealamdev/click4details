 <div class="d-flex justify-content-center mb-2">
     <div class="container featured-container">
         <div class="featured-items">
             <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
                 @foreach ($vehicles as $item => $each)
                     <div class="col" wire:click="viewCount({{ $each->id }})">
                         <div class="card rounded shadow-sm border border-slate-200">
                             @if ($each->status !== 1)
                                 <h5 class="text-danger text-center pt-2">SOLD OUT</h5>
                             @endif
                             <a href="{{ route('home.detail', ['slug' => $each?->slug]) }}"
                                 style="text-decoration: none;color: var(--bs-heading-color)">
                                 <div class="card-body p-2">
                                     <img src="{{ $each?->image?->preview() ?? 'https://placehold.co/600x400' }}"
                                         class="card-img-top rounded" loading="lazy" alt="" />
                                     <h5 class="fs-16 fw-500 mt-2 mb-0">
                                         {{ toLocaleString($each?->translate, $translate) }}
                                     </h5>
                                     <p class="fs-12 d-flex gap-1">
                                         <span>
                                             @if ($each->registration)
                                                 <i class="fa-solid fa-registered me-1"></i>
                                                 {{ toLocaleNumber($each->registration, $translate) }}
                                             @else
                                                 <span><i class="fa-solid fa-shield-halved me-1"></i>
                                                     {{ toLocaleString($each->grade?->translate, $translate) }}</span>
                                             @endif
                                         </span>
                                         <span>|</span>
                                         <span>{{ toLocaleString($each->condition?->translate, $translate) }}</span>
                                         <span>|</span>
                                         @if (!empty($each?->mileages))
                                             <span>
                                                 <i class="fa-solid fa-mill-sign"></i>
                                                 {{ toLocaleNumber($each->mileages, $translate) }}
                                             </span>
                                         @else
                                             <span>
                                                 <i class="fa-solid fa-mill-sign"></i>
                                                 {{ toLocaleString($each->mileage?->translate, $translate) }}
                                             </span>
                                         @endif

                                     </p>

                                     <div class="d-flex align-items-center justify-content-between">
                                         <div class="card-text">
                                             <p class="m-0">
                                                 <small>
                                                     {{ toLocaleString($each?->available?->translate, $translate) }}
                                                 </small>
                                             </p>
                                             <p class="m-0">
                                                 <small>
                                                     {{ 'Code : ' . $each?->code }}
                                                 </small>
                                             </p>

                                             @if ($each?->fixed_price > 0)
                                                 <h4 class="fs-18 fw-600 m-0">
                                                     {{ __('module.datalist.TK', [], $translate) }}
                                                     @if ($each?->fixed_price > 0)
                                                         {{ number_format(($each?->fixed_price ?? 0) + ($each?->additional_price ?? 0)) }}
                                                     @endif
                                                 </h4>
                                             @else
                                                 <h4 class="fs-18 fw-600 m-0">
                                                     {{ __('module.datalist.TK', [], $translate) }}
                                                     {{ $each?->price }}
                                                 </h4>
                                             @endif
                                         </div>

                                         <button class="send-whatsapp-button btn btn-sccess"
                                             onclick="sendToWhatsApp('{{ toLocaleString($each?->translate, $translate) }}','{{ $each->price }}','{{ $each?->additional_price }}','{{ $each?->fixed_price }}','{{ toLocaleString($each?->brand?->translate, $translate) }}','{{ toLocaleString($each?->edition?->translate, $translate) }}','{{ $each?->engines }}','{{ toLocaleString($each?->fuel?->translate, $translate) }}','{{ $each?->mileages }}','{{ route('home.detail', ['slug' => $each?->slug]) }}',event)">
                                             <img src="{{ asset('images/whatsapp.png') }}" alt="#"
                                                 width="30px">
                                         </button>
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

 @push('js')
     <script>
         function sendToWhatsApp(vehicleName, price, additional_price, fixed_pirce, brand, edition, engines, fuel, mileages,
             details, e) {
             e.preventDefault();
             // console.log(vehicleName, price, brand, edition, engines, fuel, mileages);
             const vehicleNameEncoded = encodeURIComponent("Vehicle Name: " + vehicleName);
             const brandEncoded = encodeURIComponent("Brand: " + brand);
             const editionEncoded = encodeURIComponent("Edition: " + edition);
             const engineEncoded = encodeURIComponent("Engines: " + engines);
             const fuelEncoded = encodeURIComponent("Fuel: " + fuel);
             const mileageEncoded = encodeURIComponent("Mileage: " + mileages);
             const productDetailsEncoded = encodeURIComponent("Click for Details: " + details);
             let finalPrice;

             if (Number(fixed_pirce) > 0) {
                 finalPrice = Number(fixed_pirce) + Number(additional_price);
             } else {
                 finalPrice = Number(price) + Number(additional_price);
             }
             console.log(fixed_pirce, finalPrice)
             const finalPriceEncode = encodeURIComponent('Final Price = ' + finalPrice)
             const whatsappLink =
                 `https://wa.me/?text=${vehicleNameEncoded}%0A${brandEncoded}%0A${editionEncoded}%0A${engineEncoded}%0A${mileageEncoded}%0A${finalPriceEncode}%0A${fuelEncoded}%0A${productDetailsEncoded}`;
             window.open(whatsappLink, "_blank");
         }
     </script>
     {{-- <script src="{{ asset('assets/js/frontend/custom.js') }}"></script>
     <script>
         sendToWhatsApp(vehicleName, price, additional_price, fixed_pirce, brand, edition, engines, fuel, mileages, details,
             e)
     </script> --}}
 @endpush
