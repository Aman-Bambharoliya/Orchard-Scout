@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('Peoples')}}</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('Home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('peoples.index')}}" class="text-muted text-hover-primary">{{__('Peoples')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">{{__('Edit')}}</li>
</ul>
@endsection
@section('main-content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        @include('layouts.errors')
        <div class="card mb-5 mb-xl-10">
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{ route('peoples.update',$data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Prefix')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Prefix')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="prefix"
                                    class="form-control form-control-lg form-control-solid @error('prefix') is-invalid @enderror"
                                    placeholder="{{__('Prefix')}}" value='{{$data->prefix}}'/>
                                @error('prefix')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('First Name')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('First Name')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="first_name"
                                    class="form-control form-control-lg form-control-solid @error('first_name') is-invalid @enderror"
                                    placeholder="{{__('First Name')}}" value='{{$data->first_name}}'/>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Middle Name')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Middle Name')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="middle_name"
                                    class="form-control form-control-lg form-control-solid @error('middle_name') is-invalid @enderror"
                                    placeholder="{{__('Middle Name')}}" value='{{$data->middle_name}}'/>
                                @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Last Name')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Last Name')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="last_name"
                                    class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror"
                                    placeholder="{{__('Last Name')}}" value='{{$data->last_name}}'/>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Suffix')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Suffix')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="suffix"
                                    class="form-control form-control-lg form-control-solid @error('suffix') is-invalid @enderror"
                                    placeholder="{{__('Suffix')}}" value='{{$data->suffix}}'/>
                                @error('suffix')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Nickname')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Nickname')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="nickname"
                                    class="form-control form-control-lg form-control-solid @error('nickname') is-invalid @enderror"
                                    placeholder="{{__('Nickname')}}" value='{{$data->nickname}}'/>
                                @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Maiden Name')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Maiden Name')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="maiden_name"
                                    class="form-control form-control-lg form-control-solid @error('maiden_name') is-invalid @enderror"
                                    placeholder="{{__('Maiden Name')}}" value='{{$data->maiden_name}}'/>
                                @error('maiden_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Date Of Birth')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Date Of Birth')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input name="date_of_birth"
                                    class="form-control form-control-lg form-control-solid @error('date_of_birth') is-invalid @enderror"
                                    placeholder="{{__('Date Of Birth')}}" id='date_of_birth' value='{{$data->date_of_birth}}'/>
                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" onclick="window.location='{{ route('peoples.index') }}'"
                            class="btn btn-light btn-active-light-primary me-2">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{url('js/module/peoples.js')}}"></script>
@endsection