@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Change Password</h1>
@endsection
@section('main-content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        @include('layouts.errors')
        <div class="card mb-5 mb-xl-10">
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{route('change-password-update')}}">
                    @csrf
                    @method('PUT')
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Current Password')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Current Password"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" id='current_password' name="current_password"
                                    class="form-control form-control-lg form-control-solid @error('current_password') is-invalid @enderror"
                                    placeholder="Current Password" {{ old('current_password') }} />
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('New Password')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="New Password"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" id='password' name="password"
                                    class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                    placeholder="New Password" value="{{ old('password') }}" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Confirm New Password')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Confirm New Password"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="confirm_password"
                                    class="password form-control form-control-lg form-control-solid @error('confirm_password') is-invalid @enderror"
                                    placeholder="Confirm New Password" />
                                @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                       
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" onclick="history.back()"
                            class="btn btn-light btn-active-light-primary me-2">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('Change Password')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{url('js/module/change-password.js')}}"></script>
@endsection