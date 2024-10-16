@extends('layouts.master')
@section('title', 'Create Vehicle')
@section('css')
    <style>
        .feature_item {
            width: 400px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Vehicle</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                @include('content.package.vehicle.product.partials.form')
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            uploadsDragDrop()
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.merchant').on('change', function() {
                var merchant_id = $('.merchant').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.vehicle.product.create') }}',
                    dataType: 'json',
                    data: {
                        merchant_id: merchant_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#codes').html(response.options);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.edition').on('change', function() {
                var edition_id = $('.edition').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.vehicle.product.create') }}',
                    dataType: 'json',
                    data: {
                        edition_id: edition_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var featuresDetail = response.features.detail_feature;
                        var featureMainDiv = $('.feature_main');
                        var select_all = $('.select-all input');
                        featureMainDiv.empty();

                        var uniqueFeatures = [];

                        var selectAllCheckbox = $('<input>').attr({
                            type: 'checkbox',
                            id: 'select-all-checkbox'
                        });

                        select_all.on('change', function() {
                            var isChecked = $(this).prop('checked');
                            featureMainDiv.find('input[type="checkbox"]').prop(
                                'checked', isChecked);
                        });

                        featuresDetail.forEach(function(detailFeature) {
                            var featureTitle = detailFeature.feature.title;
                            var featureId = detailFeature.feature.id;

                            if (!uniqueFeatures.includes(featureTitle)) {
                                var featureItemDiv = $('<div>').addClass('col-lg-3');
                                var featureTitleElement = $('<h5>').addClass(
                                    'featureTitle mt-3').text(featureTitle);

                                featureItemDiv.append(featureTitleElement);
                                uniqueFeatures.push(featureTitle);

                                featuresDetail.forEach(function(df) {
                                    if (df.feature.title === featureTitle) {
                                        var checkbox = $('<input>').attr({
                                            type: 'checkbox',
                                            value: df.detail.id,
                                            name: 'detail_id[' +
                                                featureId + '][]'
                                        });

                                        var detailTitle = $('<span>').text(df
                                            .detail.title);
                                        var br = $('<br>');
                                        var space = $('<span>').css(
                                            'margin-right', '10px');

                                        featureItemDiv.append(checkbox, space,
                                            detailTitle, br);
                                    }
                                });

                                featureMainDiv.append(featureItemDiv);
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $('#editionSelect').on('change', function() {
            var edition_id = $(this).val();

            $.ajax({
                type: 'GET',
                url: '{{ route('admin.vehicle.product.create') }}',
                dataType: 'json',
                data: {
                    edition_id: edition_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    var featuresDetail = response.features.detail_feature;
                    var featureMainDiv = $('#featureModal').find('.feature_main');
                    featureMainDiv.empty();
                    $('#featureModal').modal('show');
                }
            });
        });
    </script>
@endpush
