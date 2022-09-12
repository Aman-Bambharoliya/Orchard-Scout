@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Admin') }}</div>
                <div class="card-body">
                    <form method="POST" name='edit_frm' action="{{ route('admin-users.update',$admin_user->id) }}">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{$admin_user->name}}" autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{$admin_user->email}}" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                 autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="confirm-password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>
                            <div class="col-md-6">
                                <input id="confirm-password" type="password" class="form-control"
                                    name="confirm-password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Role')
                                }}</label>
                            <div class="col-md-6">
                                <select class="form-control form-control-solid @error('role') is-invalid @enderror"
                                    id='role' name="role">
                                    <option value=''>Select user role</option>
                                    <option value='1' @if ($admin_user->role==1)
                                        {{'selected'}}
                                    @endif>Super Admin</option>
                                    <option value='2' @if ($admin_user->role==2)
                                        {{'selected'}}
                                    @endif>Admin</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <pre>
                            @php
                                $permissions=json_decode($admin_user->permissions,true);
                            @endphp
                        </pre>
                        <div class="row mb-3 permission-section" @if ($admin_user->role==1) style='display:none' @endif>
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Permissions')
                                }}</label>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Module</th>
                                            <th scope="col">View</th>
                                            <th scope="col">Create</th>
                                            <th scope="col">Update</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($modules) && count($modules) > 0)
                                        @foreach ($modules as $module)
                                        <tr>
                                            <td>{{$module->name}}</td>
                                            <td>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <label
                                                        class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                        <input
                                                            class="form-check-input ludo-check @error('permissions') is-invalid @enderror"
                                                            name="permissions[{{$module->name}}][]" type="checkbox" value="index" @if (isset($permissions[$module->name]) && in_array( 'index',$permissions[$module->name]))
                                                            {{"checked='checked'"}}
                                                            @endif>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <label
                                                        class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                        <input
                                                            class="form-check-input ludo-check @error('permissions') is-invalid @enderror"
                                                            name="permissions[{{$module->name}}][]" type="checkbox" value="create" @if (isset($permissions[$module->name]) && in_array( 'create',$permissions[$module->name]))
                                                            {{"checked='checked'"}}
                                                            @endif>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <label
                                                        class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                        <input
                                                            class="form-check-input ludo-check @error('permissions') is-invalid @enderror"
                                                            name="permissions[{{$module->name}}][]" type="checkbox" value="update" @if (isset($permissions[$module->name]) && in_array( 'update',$permissions[$module->name]))
                                                            {{"checked='checked'"}}
                                                            @endif>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <label
                                                        class="form-check form-check-inline form-check-solid me-5 @error('permissions') is-invalid @enderror">
                                                        <input
                                                            class="form-check-input ludo-check @error('permissions') is-invalid @enderror"
                                                            name="permissions[{{$module->name}}][]" type="checkbox" value="delete" @if (isset($permissions[$module->name]) && in_array( 'delete',$permissions[$module->name]))
                                                            {{"checked='checked'"}}
                                                            @endif>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection