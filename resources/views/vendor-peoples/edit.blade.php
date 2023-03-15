@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('Vendor Peoples')}}</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('Home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('vendors.index')}}" class="text-muted text-hover-primary">{{__('Vendors')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('vendor-peoples.index',$data->vendor_id)}}" class="text-muted text-hover-primary"> {{__('Vendor Peoples')}}</a>
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
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{ route('vendor-peoples.update',$data->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name='vendor_id' value="{{$data->vendor_id}}">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('People')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('People')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="form-select form-select-solid form-select-lg  @error('people_id') is-invalid @enderror"
                                    id='people_id' name="people_id" data-control="select2">
                                    <option value=''>Select people</option>
                                    @if (!empty($Peoples) && count($Peoples) > 0)
                                    @foreach ($Peoples as $People)
                                        <option value='{{$People->id}}' @if($data->people_id==$People->id)
                                            {{'selected'}}
                                        @endif>{{$People->full_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('people_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('People Role')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('People Role')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="form-select form-select-solid form-select-lg  @error('people_role_id') is-invalid @enderror"
                                    id='people_role_id' name="people_role_id" data-control="select2">
                                    <option value=''>Select people role</option>
                                    @if (!empty($PeopleRoles) && count($PeopleRoles) > 0)
                                    @foreach ($PeopleRoles as $PeopleRole)
                                        <option value='{{$PeopleRole->id}}' @if($data->people_role_id==$PeopleRole->id)
                                            {{'selected'}}
                                        @endif>{{$PeopleRole->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('people_role_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                      
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" onclick="window.location='{{ route('vendor-peoples.index',$data->vendor_id) }}'"
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
<script src="{{url('js/module/vendor-peoples.js')}}"></script>
@endsection