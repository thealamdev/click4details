@extends('layouts.master')
@section('title', 'Update Followup message')
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
                <h4 class="mb-0">Edit Follow Up Message</h4>
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
                @include('content.package.customer-care.followup-message.partials.update-form')
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            mdeMarkdownEditor('markdown1')
        })
    </script>
@endpush