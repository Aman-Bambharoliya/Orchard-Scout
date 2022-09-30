@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('People Phones')}}</h1>
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
    <li class="breadcrumb-item text-muted">
        <a href="{{route('people-phones.index',$data->people_id)}}" class="text-muted text-hover-primary"> {{__('People Phones')}}</a>
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
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{ route('people-phones.update',$data->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name='people_id' value="{{$data->people_id}}">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Phone Type')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Phone Type')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="form-select form-select-solid form-select-lg  @error('phone_type_id') is-invalid @enderror"
                                    id='phone_type_id' name="phone_type_id">
                                    <option value=''>{{__('Select phone type')}}</option>
                                    @if (!empty($PhoneTypes) && count($PhoneTypes) > 0)
                                    @foreach ($PhoneTypes as $PhoneType)
                                        <option value='{{$PhoneType->id}}' @if ($data->phone_type_id==$PhoneType->id)
                                            {{'selected'}}
                                        @endif>{{$PhoneType->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('phone_type_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Country Code')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Country Code')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="country_code"
                                    class="form-control form-control-lg form-control-solid @error('country_code') is-invalid @enderror"
                                    placeholder="{{__('Country Code')}}" value='{{$data->hasPhone->country_code}}'/>
                                @error('country_code')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Area Code')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Area Code')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="area_code"
                                    class="form-control form-control-lg form-control-solid @error('area_code') is-invalid @enderror"
                                    placeholder="{{__('Area Code')}}" value='{{$data->hasPhone->area_code}}'/>
                                @error('area_code')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Prefix')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Prefix')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="prefix"
                                    class="form-control form-control-lg form-control-solid @error('prefix') is-invalid @enderror"
                                    placeholder="{{__('Prefix')}}" value='{{$data->hasPhone->prefix}}'/>
                                @error('prefix')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Number')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Number')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="number"
                                    class="form-control form-control-lg form-control-solid @error('number') is-invalid @enderror"
                                    placeholder="{{__('Number')}}" value='{{$data->hasPhone->number}}'/>
                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Extension')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Extension')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="extension"
                                    class="form-control form-control-lg form-control-solid @error('extension') is-invalid @enderror"
                                    placeholder="{{__('Extension')}}" value='{{$data->hasPhone->extension}}'/>
                                @error('extension')
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
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{url('js/module/people-phones.js')}}"></script>
@endsection