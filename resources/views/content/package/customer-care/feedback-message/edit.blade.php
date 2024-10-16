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
                <h4 class="mb-0">Edit Feedback Message</h4>
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
                <form
                    action="{{ route('admin.customer-care.feedback-message.update', ['feedbackMessage' => $feedbackMessage->id]) }}"
                    method="POST" accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="row gx-3">
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="message">Message<span
                                        class="ms-1 text-red-600">*</span></label>

                                <textarea name="message" class="form-control" value="{{ old('message', $feedbackMessage->message) }}"
                                    placeholder="enter feedback message" cols="30" rows="10">{!! $feedbackMessage->message !!}</textarea>
                                @error('message')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-500 mb-1" for="status">Status<span
                                        class="ms-1 text-red-600">*</span></label>
                                <select class="form-select @error('status') {{ 'is-invalid' }} @enderror" name="status"
                                    required>
                                    <option selected disabled>Please Select...</option>
                                    <option value="1" @selected(old('status', $feedbackMessage->status) == '1')>Active</option>
                                    <option value="0" @selected(old('status', $feedbackMessage->status) == '0')>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-dark border-0">
                                <i class="fa-solid fa-plus me-1"></i>Confirm
                            </button>
                            <a href="{{ route('admin.customer-care.feedback-message.index') }}"
                                class="btn btn-default">
                                <i class="fa-solid fa-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
