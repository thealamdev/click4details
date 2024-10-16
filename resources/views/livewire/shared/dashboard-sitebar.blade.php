<div class="col-lg-3">
    <ul class="list-group">
        <li class="list-group-item">Dashboard</li>
        <li class="list-group-item">
            My Orders
            <ul class="list-group">
               <li wire:click="orders" class="list-group-item cursor-pointer">All Order</li>
                <li wire:click='pendingOrder' class="list-group-item">Pending Order</li>
            </ul>
        </li>
        {{-- <li class="list-group-item">
            Order Manage
        </li>
        <li class="list-group-item">
            Manage my Account
            <ul class="list-group">
                <li class="list-group-item">Sub-item 1</li>
                <li class="list-group-item">Sub-item 2</li>
                <li class="list-group-item">Sub-item 3</li>
            </ul>
        </li>
        <li class="list-group-item">
            My Reviews
            <ul class="list-group">
                <li class="list-group-item">Sub-item 1</li>
                <li class="list-group-item">Sub-item 2</li>
                <li class="list-group-item">Sub-item 3</li>
            </ul>
        </li> --}}
    </ul>
</div>