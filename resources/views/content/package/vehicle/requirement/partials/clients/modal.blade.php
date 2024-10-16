<div class="modal fade detail{{ $each?->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    @php
        $requirement = $requirements?->where('id', $each->id)->first();
    @endphp
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Requirement of
                    {{ $requirement?->name }}, Mobile: {{ $requirement?->mobile }}
                    From: {{ $requirement?->location }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <!-- Requirement part !-->
                @include('content.package.vehicle.requirement.partials.clients.requirement')
                <!-- Follow up part !-->
                <hr>
                @include('content.package.vehicle.requirement.partials.clients.followup-feedback')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
