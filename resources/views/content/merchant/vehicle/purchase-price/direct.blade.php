<form id="storeModal" action="{{ route('merchant.vehicle.purchase-price.directStore', ['vehicle' => $vehicle->id]) }}"
    method="POST">
    @csrf
    <input class="form-control mb-3" type="password" name="password" placeholder="enter password">
    <button type="submit" class="btn btn-primary">Confirm</button>
</form>
