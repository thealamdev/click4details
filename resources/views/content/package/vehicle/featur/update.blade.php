@extends('layouts.master')
@section('title', 'Create Detail')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Create Detail Of <form class="d-inline-block"
                        action="{{ route('admin.vehicle.featur.update', ['featur' => $featur->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <input name="title" class="border-0 bg-transparent" style="outline: none !important;" value="{{ $featur->title }}" type="text">
                    </form>
                </h4>
                <p>Prior to creating a resource, make sure asterisk (*) signs are filled</p>
            </div>
        </div>
        <div class="card rounded border border-gray-300">
            <div class="card-body">
                <button class="add btn btn-success">&plus;</button>
                <div class="row">
                    <div class="col-lg-6">
                        <form class="form" action="{{ route('admin.vehicle.detail.store') }}" method="POST"
                            accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                            @csrf
                            <input type="hidden" name="featur_id" value="{{ $featur->id }}">
                        </form>
                    </div>

                    <div class="col-lg-6">
                        <div class="card rounded border border-gray-300">
                            <div class="card-body">
                                <table id="dataTable" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Title</th>
                                            <th><i class="fa-solid fa-trash"></i></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if (is_object($details) && $details->count() > 0)
                                            @foreach ($details as $n => $each)
                                                <tr>
                                                    <td>{{ str()->padLeft(++$n, 2, '0') }}</td>
                                                    <td>
                                                        <form
                                                            action="{{ route('admin.vehicle.detail.update', ['detail' => $each->id]) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf
                                                            <input type="text" class="form-control"
                                                                value="{{ $each->title }}" name="title"
                                                                placeholder="Update detail">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('admin.vehicle.detail.delete', ['detail' => $each->id]) }}"
                                                            method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger" type="submit">&times;</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="mt-4">

                            <a href="{{ route('admin.vehicle.detail.index') }}" class="btn btn-default">
                                <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const addBtn = document.querySelector('.add');
        const form = document.querySelector('.form');

        function removeInput() {
            this.parentElement.remove();
        }

        function addInput() {
            let flex = document.createElement('div');
            flex.className = 'd-flex align-items-center';
            let title = document.createElement('input');
            title.type = 'text';
            title.name = 'title[]';
            title.placeholder = 'Enter Your Title';
            title.className = 'form-control mt-3';
            let deleteBtn = document.createElement('button');
            deleteBtn.className = 'btn btn-danger ms-4 mt-3';
            deleteBtn.innerHTML = '&times;';
            deleteBtn.addEventListener('click', removeInput);

            flex.appendChild(title);
            flex.appendChild(deleteBtn);
            form.insertBefore(flex, form.lastElementChild);
        }

        addBtn.addEventListener('click', addInput);

        // Add the submit button
        let submit = document.createElement('button');
        submit.type = 'submit';
        submit.innerHTML = 'Submit';
        submit.className = 'btn btn-primary mt-3';
        form.appendChild(submit);
    </script>
@endpush
