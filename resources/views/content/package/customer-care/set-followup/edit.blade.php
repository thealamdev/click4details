<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.vehicle.customer.followup-message.store', ['customer' => $customer->id]) }}"
            method="POST">
            @csrf

            <div class="mb-3">
                <label for="package">Package Message Service</label>
                <select name="package_id" id="package_id" class="form-control">
                    <option disabled>--select a PMS--</option>
                    @foreach ($package_message_service as $each)
                        <option value="{{ $each->followup_package_id }}">
                            {{ $each->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="starting_date">Starting Date</label>
                <input type="date" name="starting_date" class="form-control">
            </div>

            <div class="mb-3">
                <label for="visit_date">Visit Date</label>
                <input type="date" name="visit_date" class="form-control">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

        </form>
    </div>
</div>
</div>
