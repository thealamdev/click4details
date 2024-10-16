@extends('layouts.master')
@section('title', 'Client Requirements')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">All Clients Requirement List</h4>
            <p class="mb-0">Manage all the requirement list</p>
        </div>
        <div class="dropdown me-1">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,10">
                Quick Navigation
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.vehicle.product.create') }}">
                        Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                        href="{{ route('admin.vehicle.product.index') }}">
                        Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
            </ul>
        </div>
    </div>

    <div class="mb-3">
        @include('content.package.vehicle.requirement.partials.clients.search')
    </div>

    <div class="card rounded border border-gray-300">
        <div class="card-body">
            @include('content.package.vehicle.requirement.partials.clients.table')

            @if (method_exists($requirements, 'links'))
                {{ $requirements->links() }}
            @endif

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var attributes = [
                '.brands', '.condition',
                '.skeleton',
                '.transmission', '.model', '.color', '.grade', '.available', '.registration', '.fuel',
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
        $(document).ready(function() {
            $(document).on('click', '#bootModalShow', function(e) {
                e.preventDefault();
                let dialog = '';
                let modalUrl = $(this).attr('href');
                let formUrl = $(this).attr('formActionUrl');
                let title = $(this).attr('title');

                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(response) {
                        dialog = bootbox.dialog({
                            title: title,
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(response);
                    }
                });

                $(document).on('submit', '#createOrUpdateModal', function(e) {
                    e.preventDefault();
                    let formData = new FormData($('#createOrUpdateModal')[0]);
                    $.ajax({
                        type: "POST",
                        url: formUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            dialog.modal('hide')
                        }
                    });
                });

            });
        });
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
