<form id="storeModal" action="{{ route('merchant.vehicle.purchase-price.store') }}" method="POST">
    @csrf
    <input class="form-control mb-3" type="password" name="password" placeholder="enter password">
    <button type="submit" class="btn btn-primary">Confirm</button>
</form>
