@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        @include('content.package.vehicle.product.partials.navigation')
    </div>

    <div class="card rounded border border-gray-300 mb-3">
        <div class="card-body">
            @include('content.package.vehicle.product.partials.search')
        </div>
    </div>

    <div class="card rounded border border-gray-300">
        <div class="card-body">
            @include('content.package.vehicle.product.partials.table')
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [20, 40, 60, 100, -1],
                    [20, 40, 60, 100, "All"]
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script>
        function sendToWhatsApp(vehicleName, brand, edition, engine, fuel, mileage, passedPrice, image) {
            const row = event.target.closest('tr');
            const selectedPrice = getSelectedPrice(row, passedPrice);

            const vehicleNameEncoded = encodeURIComponent("Vehicle Name: " + vehicleName);
            const productPriceEncoded = encodeURIComponent("Price: " + selectedPrice);
            const brandEncoded = encodeURIComponent("Brand: " + brand);
            const editionEncoded = encodeURIComponent("Edition: " + edition);
            const engineEncoded = encodeURIComponent("Edition: " + engine);
            const fuelEncoded = encodeURIComponent("Fuel: " + fuel);
            const mileageEncoded = encodeURIComponent("Mileage: " + mileage);
            const productImageEncoded = encodeURIComponent("Image: " + image);

            const whatsappLink =
                `https://wa.me/?text=${vehicleNameEncoded}%0A${brandEncoded}%0A${editionEncoded}%0A${engineEncoded}%0A${mileageEncoded}%0A${productPriceEncoded}%0A${fuelEncoded}%0A${productImageEncoded}`;
            window.open(whatsappLink, "_blank");
        }

        function getSelectedPrice(row, passedPrice) {
            const priceCheckbox = row.querySelector('.price-checkbox');
            const purchasePriceCheckbox = row.querySelector('.purchase-price-checkbox');
            const fixedPriceCheckbox = row.querySelector('.fixed-price-checkbox');
            const additionalPrice = row.querySelector('.additional-price-checkbox');

            // if (priceCheckbox && priceCheckbox.checked) {
            //     return Number(priceCheckbox.getAttribute('data-price')) + Number9 additionalPrice.getAttribute(
            //         'data-additional-price');
            // } else if (purchasePriceCheckbox && purchasePriceCheckbox.checked) {
            //     return Number(purchasePriceCheckbox.getAttribute('data-purchase-price')) + Number(additionalPrice
            //         .getAttribute(
            //             'data-additional-price'));
            // } else if (fixedPriceCheckbox && fixedPriceCheckbox.checked) {
            //     return Number(fixedPriceCheckbox.getAttribute('data-fixed-price')) + Number(additionalPrice.getAttribute(
            //         'data-additional-price'));
            // } else {
            //     return passedPrice;
            // }
            if (priceCheckbox && priceCheckbox.checked) {
                const price = Number(priceCheckbox.getAttribute('data-price'));
                if (isNaN(price)) {
                    console.error('Invalid data-price attribute on priceCheckbox');
                    return passedPrice; // Or handle the error differently, e.g., throw an exception
                }
                return price + Number(additionalPrice.getAttribute('data-additional-price'));
            } else if (purchasePriceCheckbox && purchasePriceCheckbox.checked) {
                const purchasePrice = Number(purchasePriceCheckbox.getAttribute('data-purchase-price'));
                if (isNaN(purchasePrice)) {
                    console.error('Invalid data-purchase-price attribute on purchasePriceCheckbox');
                    return passedPrice; // Or handle the error differently
                }
                return purchasePrice + Number(additionalPrice.getAttribute('data-additional-price'));
            } else if (fixedPriceCheckbox && fixedPriceCheckbox.checked) {
                const fixedPrice = Number(fixedPriceCheckbox.getAttribute('data-fixed-price'));
                if (isNaN(fixedPrice)) {
                    console.error('Invalid data-fixed-price attribute on fixedPriceCheckbox');
                    return passedPrice; // Or handle the error differently
                }
                return fixedPrice + Number(additionalPrice.getAttribute('data-additional-price'));
            } else {
                return passedPrice;
            }

        }
    </script>

    <script>
        $(document).ready(function() {
            var attributes = [
                '.brands', '.condition',
                '.skeleton',
                '.transmission', '.model', '.manufacture', '.color', '.grade', '.available', '.registration',
                '.fuel',
                '.edition', '.feature'
            ];

            attributes.forEach(function(e) {
                $(e).select2({
                    placeholder: 'Enter ' + e.substring(
                        1)
                });
            });
        });
    </script>

    <script>
        var input = document.querySelectorAll('.formInput');
        input.forEach((element, index) => {
            element.addEventListener('keyup', function() {
                if (event.key === "Enter") {
                    input[index + 1].focus()
                }
            })
        });

        var submit = document.querySelector('.submit')
        submit.addEventListener('focus', function() {
            this.type = "submit"
        })
    </script>


    <script>
        function deleteItem(e) {
            if (e.getAttribute('type') == 'button') {
                if (confirm('Are you sure to delete this ???') == true) {
                    let type = e.setAttribute('type', 'submit')
                }
            }
        }
    </script>
@endpush
