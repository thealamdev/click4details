 <header class="py-3 container">
     <h5>Rental Cars Category</h5>
 </header>

 <div class="d-flex justify-content-center mb-2">
     <div class="container featured-container">
         <div class="featured-items">
             <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-2 g-lg-3">
                 @forelse ($responses as $each)
                     <div class="col">
                         <div class="card rounded shadow-sm border border-slate-200">
                             <a href="{{ route('home.rental.category.car.detail', ['slug' => $each?->slug]) }}" style="text-decoration: none;color: var(--bs-heading-color);">
                                 <div class="card-body p-2">
                                     <img src="{{ $each?->image->preview() ?? 'https://placehold.co/600x400' }}" class="card-img-top rounded" loading="lazy" alt="" />
                                     <h5 class="fw-500 mt-2 mb-0">
                                         {{ toLocaleString($each?->translate, $translate) }}
                                     </h5>


                                     <p class="fs-14 d-flex gap-1 mb-0">
                                         <span class="fs-14">
                                             Seat : {{ $each?->seat }}
                                         </span>
                                         <span>|</span>
                                         <span class="fs-14">{{ toLocaleString($each->carmodel->translate, $translate) }}</span>
                                         <span>|</span>
                                         <span class="fs-14">{{ $each?->ac }}</span>
                                     </p>

                                     <div class="d-flex align-items-center justify-content-between">
                                         <div class="card-text">
                                             <h5>Daily Rent : {{ $each?->daily_charge_inside_dhaka }} tk</h5>
                                             <h5>Other in details</h5>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         </div>
                     </div>
                 @empty
                     <div class="text-center">
                         <h5 class="text-danger">No Data Available !!!</h5>
                     </div>
                 @endforelse
             </div>
         </div>
     </div>
 </div>
