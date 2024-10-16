<form action="{{ route('admin.vehicle.requirement.search') }}" method="GET">
    <div class="row">
        <div class="col-lg-1">
            <div class="mt-1">
                <label for="content">All</label>
                <input type="radio" name="content" checked value="orwhereHas"
                    {{ request()->content == 'orwhereHas' ? 'checked' : '' }}>

                <label for="content">Fixed</label>
                <input type="radio" name="content" value="whereHas"
                    {{ request()->content == 'whereHas' ? 'checked' : '' }}>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select formInput brands" name="brand[]" multiple="multiple">
                    <option disabled>--Brand--</option>
                    @foreach ($composeBrand as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('brand')) ? 'selected' : '' }}>
                            {{ $each->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select formInput model @error('model') {{ 'is-invalid' }} @enderror"
                    multiple="multiple" name="model[]">
                    <option disabled>Please Select...</option>
                    @foreach ($composeCarmodel as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('model')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select
                    class="form-select manufacture formInput @error('manufacture') {{ 'is-invalid' }} @enderror"
                    multiple="multiple" name="manufacture[]">
                    <option disabled>Please Select...</option>
                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                        <option value="{{ $i }}"
                            {{ in_array($i, (array) request()->input('manufacture')) ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
                @error('manufacture')
                    <div class=" text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select formInput edition @error('edition') {{ 'is-invalid' }} @enderror"
                    multiple="multiple" name="edition[]" id="editionSelect">
                    <option disabled>Please Select...</option>
                    @foreach ($composeEdition as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('edition')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select
                    class="form-select formInput condition @error('condition') {{ 'is-invalid' }} @enderror"
                    multiple="multiple" name="condition[]">
                    <option disabled>Please Select...</option>
                    @foreach ($composeCondition as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('condition')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <input type="number" value="{{ request()->mileage_start }}" name="mileage_start"
                    class="form-control" placeholder="mileage start">
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <input type="number" value="{{ request()->mileage_end }}" name="mileage_end"
                    class="form-control" placeholder="mileage end">
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select formInput fuel @error('fuel') {{ 'is-invalid' }} @enderror"
                    name="fuel[]" multiple="multiple">
                    <option disabled>Please Select...</option>
                    @foreach ($composeFuel as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('fuel')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select formInput grade @error('grade') {{ 'is-invalid' }} @enderror"
                    name="grade[]" multiple="multiple">
                    <option disabled>Please Select...</option>
                    @foreach ($composeGrade as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('grade')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select
                    class="form-select registration formInput @error('registration') {{ 'is-invalid' }} @enderror"
                    multiple="multiple" name="registration[]">
                    <option disabled>Please Select...</option>
                    @for ($i = date('Y'), $n = date('Y', strtotime('-50 Years')); $i > $n; $i--)
                        <option value="{{ $i }}"
                            {{ in_array($i, (array) request()->input('registration')) ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select formInput color @error('color') {{ 'is-invalid' }} @enderror"
                    name="color[]" multiple="multiple">
                    <option disabled>Please Select...</option>
                    @foreach ($composeColor as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('color')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <select class="form-select feature formInput @error('feature') {{ 'is-invalid' }} @enderror"
                    name="feature[]" multiple="multiple">
                    <option disabled>Please Select...</option>
                    @foreach ($composeFeature as $each)
                        <option value="{{ $each->title }}"
                            {{ in_array($each->title, (array) request()->input('feature')) ? 'selected' : '' }}>
                            {{ $each->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-1">
            <div class="mt-1">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
    </div>
</form>