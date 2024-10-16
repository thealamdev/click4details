@extends('layouts.master')
@section('title', 'Contacts')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h4 class="mb-0">Contacts</h4>
        <p class="mb-0">Manage all the contacts datalist</p>
    </div>
    <div class="dropdown me-1">
        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
            Quick Navigation
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
            <li>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                    Export Excel<i class="fa-solid fa-file-lines text-body text-opacity-50"></i>
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                    Stream PDF<i class="fa-solid fa-bolt text-body text-opacity-50"></i>
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                    Download PDF<i class="fa-solid fa-shield-halved text-body text-opacity-50"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="card rounded border border-gray-300">
    <div class="card-body">
        <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Client</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Modified</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th>Sl</th>
                    <th>Client</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Modified</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        renderDataTable('#dataTable')
    });
</script>
@endpush