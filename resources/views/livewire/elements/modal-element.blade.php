<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h1 class="modal-title fs-18">Please Choose Contact</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-2 g-2">
                    @foreach ($contacts as $each)
                    <div class="col">
                    <a href="{{ sprintf('https://wa.me/%s?text=Hello Pilot Bazar!', $each) }}" class="card card-body text-decoration-none" aria-current="true">
                        <div><i class="fa-solid fa-phone me-1"></i>Direct Call</div>
                        <h6 class="mb-0">{{ $each }}</h6>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>