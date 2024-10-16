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
                <h4 class="mb-0">Create Follow Up Package</h4>
                <p>Prior to create resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>

        <div class="card rounded border border-gray-300">
            <div class="card-body">
                @include('content.package.customer-care.followup-package.partials.form')
            </div>
        </div>

        <!-- package table !-->
        <div class="card rounded border border-slate-300">
            <div class="card-body">
                @include('content.package.customer-care.followup-package.partials.table')
            </div>
        </div>
    </div>
@endsection

@push('script')
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
