@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Users</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin-users.index')}}" class="text-muted text-hover-primary">Users</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Add</li>
</ul>
@endsection
@section('main-content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        @include('layouts.errors')
        <div class="card mb-5 mb-xl-10">
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{ route('admin-users.store') }}">
                    @csrf
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Names')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Name of User"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name"
                                    class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                    placeholder="Name" {{ old('name') }} />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Email')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="User Email"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email"
                                    class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                    placeholder="Email" value="{{ old('email') }}" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Password')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="User Password"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password"
                                    class="password form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                    placeholder="Password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Confirm Password')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Confirm Password"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="confirm-password"
                                    class="form-control form-control-lg form-control-solid @error('confirm-password') is-invalid @enderror"
                                    placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Role')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Role"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="form-select form-select-solid form-select-lg  @error('role') is-invalid @enderror"
                                    id='role' name="role">
                                    <option value=''>Select user role</option>
                                    <option value='1' @if (old('role')==1) {{'selected'}} @endif>Super Admin</option>
                                    <option value='2' @if (old('role')==2) {{'selected'}} @endif>User</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6 permission-section">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Permissions')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Role"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <div
                                    class="table-responsive permission-tabel @error('permissions') is-invalid @enderror">
                                    <table class="table table-rounded table-striped border gy-3 gs-7">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                                <th style='padding-left: 30px;'>Module</th>
                                                <th style='padding-left: 30px;'>View</th>
                                                <th style='padding-left: 30px;'>Create</th>
                                                <th style='padding-left: 30px;'>Update</th>
                                                <th style='padding-left: 30px;'>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($modules) && count($modules) > 0)
                                            @foreach ($modules as $module)
                                            <tr>
                                                <td>{{str_replace("-", ' ', ucwords($module->name, "-"))}}</td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                        <label
                                                            class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                            <input
                                                                class="form-check-input  @error('permissions') is-invalid @enderror"
                                                                name="permissions[{{$module->name}}][]" type="checkbox"
                                                                value="index">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                        <label
                                                            class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                            <input
                                                                class="form-check-input @error('permissions') is-invalid @enderror"
                                                                name="permissions[{{$module->name}}][]" type="checkbox"
                                                                value="create">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                        <label
                                                            class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                            <input
                                                                class="form-check-input @error('permissions') is-invalid @enderror"
                                                                name="permissions[{{$module->name}}][]" type="checkbox"
                                                                value="update">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                        <label
                                                            class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                            <input
                                                                class="form-check-input @error('permissions') is-invalid @enderror"
                                                                name="permissions[{{$module->name}}][]" type="checkbox"
                                                                value="delete">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                @error('permissions')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset"
                            class="btn btn-light btn-active-light-primary me-2">{{__('Discard')}}</button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('Save
                            Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{url('js/module/admins.js')}}"></script>
@endsection