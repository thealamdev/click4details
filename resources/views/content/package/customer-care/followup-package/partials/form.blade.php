<form action="{{ route('admin.customer-care.followup-package.store') }}" method="POST" accept-charset="utf-8"
    autocomplete="on" class="need-validation" novalidate>
    @csrf

    <div class="row gx-3">
        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="name">Package Name<span class="ms-1 text-red-600">*</span>
                </label>
                <input type="text" name="name" placeholder="enter package name" class="form-control">

                @error('name')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="message">Stage<span
                        class="ms-1 text-red-600">*</span></label>
                <select name="stage" class="form-control">
                    <option disabled>--select a message stage--</option>
                    <option value="initial">Initial</option>
                    <option value="after visit">After Visit</option>
                    <option value="after purchase">After Purchase</option>
                </select>

                @error('stage')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="starting_day">Starting Day<span
                        class="ms-1 text-red-600">*</span></label>
                <select name="starting_day" class="form-control">
                    <option disabled>--select a starting day --</option>
                    @foreach ($daysOfWeek as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach

                </select>

                @error('starting_day')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="visit_day">Visit Day<span
                        class="ms-1 text-red-600">*</span></label>
                <select name="visit_day" class="form-control">
                    <option disabled>--select a visit day --</option>
                    @foreach ($daysOfWeek as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach

                </select>

                @error('visit_day')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark border-0">
                <i class="fa-solid fa-plus me-1"></i>Confirm
            </button>
        </div>
</form>
