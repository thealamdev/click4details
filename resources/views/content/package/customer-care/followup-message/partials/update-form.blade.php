<form action="{{ route('admin.customer-care.followup-message.update', ['followupMessage' => $followupMessage->id]) }}"
    method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
    @csrf
    @method('put')

    <div class="col-12 col-md-12">
        <div class="form-group mb-3">
            <label class="form-label fw-500 mb-1" for="message">Stage<span class="ms-1 text-red-600">*</span></label>
            <select name="stage" class="form-control">
                <option disabled>--select a message stage--</option>
                <option value="initial" @selected(old('stage', $followupMessage->stage) == 'initial')>Initial</option>
                <option value="after visit" @selected(old('stage', $followupMessage->stage) == 'after visit')>After Visit</option>
                <option value="after purchase" @selected(old('stage', $followupMessage->stage) == 'after purchase')>After Purchase</option>
            </select>

            @error('stage')
                <div class="invalid-feedback text-red-600">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row gx-3">
        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="message">Message<span
                        class="ms-1 text-red-600">*</span></label>

                <textarea name="message" id="markdown1" class="form-control" value="{{ old('message', $followupMessage->message) }}"
                    placeholder="enter follow up message" cols="30" rows="10">{!! $followupMessage->message !!}</textarea>
                @error('message')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group mb-3">
                <label class="form-label fw-500 mb-1" for="status">Status<span
                        class="ms-1 text-red-600">*</span></label>
                <select class="form-select @error('status') {{ 'is-invalid' }} @enderror" name="status" required>
                    <option selected disabled>Please Select...</option>
                    <option value="1" @selected(old('status', $followupMessage->status) == '1')>Active</option>
                    <option value="0" @selected(old('status', $followupMessage->status) == '0')>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark border-0">
                <i class="fa-solid fa-plus me-1"></i>Confirm
            </button>
            <a href="{{ route('admin.customer-care.followup-message.index') }}" class="btn btn-default">
                <i class="fa-solid fa-arrow-left me-1"></i>Back to List
            </a>
        </div>
</form>
