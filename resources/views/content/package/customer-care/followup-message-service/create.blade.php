@extends('layouts.master')
@section('title', 'Create Vehicle')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Follow Up Package</h4>
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
                @include('content.package.customer-care.followup-message-service.partials.form')
            </div>
        </div>

        @include('content.package.customer-care.followup-message-service.partials.table')
    </div>
@endsection

@push('script')
    <script>
        $('#package_id').change(function(e) {
            e.preventDefault();
            var package_id = $('#package_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('admin.customer-care.followup-message-service.create') }}",
                data: {
                    package_id: package_id
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let options = '';

                    // Construct options for <select>
                    for (let i = 0; i < response.messages.length; i++) {
                        options +=
                            `<option value='${response.messages[i].id}'>${response.messages[i].stage}--${response.messages[i].message}</option>`;
                    }

                    // Construct table rows
                    let tableRows = '';

                    for (let i = 0; i < response.followup_message.length; i++) {
                        let rowData = response.followup_message[i];
                        // Construct the HTML for the table row
                        tableRows += `
                    <tr>
                        <td>${rowData.id}</td>
                        <td>${rowData.name}</td>
                        <td>${rowData.send_day}</td>
                        <td>${rowData.message.message}</td>
                    </tr>`;
                    }

                    // Add the rows HTML to the tbody
                    $('#table').html(tableRows);



                    $('#messageOptions').html(options);


                }
            });
        });
    </script>
@endpush
