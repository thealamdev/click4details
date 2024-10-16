@push('css')
    <style>
        .submenu {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .main-row.active+.submenu {
            display: table-row;
            opacity: 1;
        }

        .main-row.active .toggle-icon {
            background-color: red;
        }

        .icon_style {
            width: 20px;
            height: 20px;
            display: inline-block;
            border-radius: 50%;
            line-height: 20px;
            vertical-align: middle;
            text-align: center;
            background: #00830b;
        }

        .list-group-item ul.list-group li {
            border: none;
        }
    </style>
@endpush
<div>
    <div class="container">
        <div class="row">
            @include('livewire.shared.dashboard-sitebar')

            <div class="col-lg-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">My
                            Orders</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button wire:click="pendingOrder" class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Pending Order</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button wire:click="paidOrder" class="nav-link" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                            aria-selected="false">Paid Order</button>
                    </li>
                </ul>
                <div class="container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Order ID</th>
                                        <th>Order Status</th>
                                        <th>Due</th>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="main-row" onclick="toggleSubmenu(this)">
                                            <td class="text-center cursor-pointer">
                                                <span class="toggle-icon border icon_style"><i
                                                        class="fa-solid fa-plus text-light"></i></span>
                                            </td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->transaction_id }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->order_status }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->due }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->payment_status }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->payable_amount }}</td>
                                            @if ($order->order_status == 'pending')
                                                <td style="color:#fff;background:#0883d4">
                                                    <button style="z-index: 9999"
                                                        wire:click="cancleOrder({{ $order->transaction_id }})"
                                                        class="btn border">Cancle</button>
                                                </td>
                                            @endif

                                        </tr>
                                        <tr class="submenu" style="display: none;">
                                            <td></td>
                                            <td colspan="5">
                                                @if (count($order->card_order) > 0)
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Unit Price</th>
                                                                <th>Quantity</th>
                                                                <th>Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->card_order as $each)
                                                                <tr>
                                                                    <td>{{ $each->title }}</td>
                                                                    <td>{{ $each->unit_price }}</td>
                                                                    <td>{{ $each->quantity }}</td>
                                                                    <td>{{ $each->sub_total }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Order ID</th>
                                        <th>Order Status</th>
                                        <th>Due</th>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="main-row" onclick="toggleSubmenu(this)">
                                            <td class="text-center cursor-pointer">
                                                <span class="toggle-icon border icon_style"><i
                                                        class="fa-solid fa-plus text-light"></i></span>
                                            </td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->transaction_id }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->order_status }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->due }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->payment_status }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->payable_amount }}</td>
                                        </tr>
                                        <tr class="submenu" style="display: none;">
                                            <td></td>
                                            <td colspan="5">
                                                @if (count($order->card_order) > 0)
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Unit Price</th>
                                                                <th>Quantity</th>
                                                                <th>Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->card_order as $each)
                                                                <tr>
                                                                    <td>{{ $each->title }}</td>
                                                                    <td>{{ $each->unit_price }}</td>
                                                                    <td>{{ $each->quantity }}</td>
                                                                    <td>{{ $each->sub_total }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Order ID</th>
                                        <th>Order Status</th>
                                        <th>Due</th>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="main-row" onclick="toggleSubmenu(this)">
                                            <td class="text-center cursor-pointer">
                                                <span class="toggle-icon border icon_style"><i
                                                        class="fa-solid fa-plus text-light"></i></span>
                                            </td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->transaction_id }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->order_status }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->due }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->payment_status }}</td>
                                            <td style="color:#fff;background:#0883d4">{{ $order->payable_amount }}</td>
                                            <td>
                                                <button class="btn btn-danger">Cancle</button>
                                            </td>
                                        </tr>
                                        <tr class="submenu" style="display: none;">
                                            <td></td>
                                            <td colspan="5">
                                                @if (count($order->card_order) > 0)
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Unit Price</th>
                                                                <th>Quantity</th>
                                                                <th>Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->card_order as $each)
                                                                <tr>
                                                                    <td>{{ $each->title }}</td>
                                                                    <td>{{ $each->unit_price }}</td>
                                                                    <td>{{ $each->quantity }}</td>
                                                                    <td>{{ $each->sub_total }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@push('script')
    <script>
        function toggleSubmenu(row) {
            const mainRow = row;
            const submenu = mainRow.nextElementSibling;
            mainRow.classList.toggle('active');
            const toggleIcon = mainRow.querySelector('.toggle-icon i');

            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'table-row';
                toggleIcon.classList.remove('fa-plus');
                toggleIcon.classList.add('fa-minus');
                mainRow.style.backgroundColor = 'red';
            } else {
                submenu.style.display = 'none';
                toggleIcon.classList.remove('fa-minus');
                toggleIcon.classList.add('fa-plus');
                mainRow.style.backgroundColor = '#0883d4';
            }
        }
    </script>
@endpush
