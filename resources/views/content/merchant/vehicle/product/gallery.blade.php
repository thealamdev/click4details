@extends('layouts.master')
@section('title', 'Vehicle Gallery')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Vehicle Gallery</h4>
                <p>Prior to create a new role, make sure asterisk (*) signs are filled</p>
            </div>
        </div>

        @if (is_object($vehicle->gallery) && $vehicle->gallery->count() > 0)
            <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-5 g-3 mb-3">
                @foreach ($vehicle->gallery as $each)
                    <div class="col">
                        <div class="card">
                            <div class="card-body pb-0">
                                 
                                <img src="{{ $each->preview() ?? 'https://via.placeholder.com/600x400/c9d2e3/212837' }}"
                                    alt="" class="card-img-top rounded" />
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h6 class="m-0 fw-500 fs-12 text-gray-400">Last Modified</h6>
                                    <p class="m-0 fs-13">{{ $each->updated_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    <form
                                        action="{{ route('merchant.vehicle.gallery.delete', ['vehicle' => $vehicle->id, 'gallery' => $each->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-secondary btn-sm text-decoration-none">
                                            <i class="fa-solid fa-trash me-1"></i>Trash
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <form action="{{ route('merchant.vehicle.gallery.store', ['vehicle' => $vehicle->id]) }}" method="POST"
                    accept-charset="utf-8" autocomplete="on"  class="need-validation" novalidate
                    enctype="multipart/form-data">
                    @csrf


                    <div class="row gx-3">
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="image">Thumbnail Images</label>
                                <input type="file" name="image[]" class="form-control @error('image') {{ 'is-invalid' }} @enderror" multiple
                                    accept=".png, .jpg, .jpeg" required />
                                @error('image')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mt-4">
                        <button type="submit" class="btn btn-dark border-0">
                            <i class="fa-solid fa-plus me-1"></i>Confirm & Save
                        </button>
                        <a href="{{ route('merchant.vehicle.product.index') }}" class="btn btn-default">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            uploadsDragDrop()
        })
    </script>
    <script>
        let myDropzone = new Dropzone("#upload_files", {
            thumbnailWidth: 400,
            maxFilesize: 1000,
        });
    </script>
@endpush
