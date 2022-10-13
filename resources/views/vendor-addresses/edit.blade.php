@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('Vendor Addresses')}}</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('Home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('vendors.index')}}" class="text-muted text-hover-primary">{{__('Vendor')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('vendor-addresses.index',$data->vendor_id)}}" class="text-muted text-hover-primary"> {{__('Vendor Addresses')}}</a>
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
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{ route('vendor-addresses.update',$data->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name='vendor_id' value="{{$data->vendor_id}}">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Address Type')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Address Type')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="form-select form-select-solid form-select-lg  @error('address_type_id') is-invalid @enderror"
                                    id='address_type_id' name="address_type_id">
                                    <option value=''>Select address type</option>
                                    @if (!empty($AddressTypes) && count($AddressTypes) > 0)
                                    @foreach ($AddressTypes as $AddressType)
                                        <option value='{{$AddressType->id}}' @if($data->address_type_id==$AddressType->id)
                                            {{'selected'}}
                                        @endif>{{$AddressType->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('address_type_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Address line 1')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Address line 1')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address_1"
                                    class="form-control form-control-lg form-control-solid @error('address_1') is-invalid @enderror"
                                    placeholder="{{__('Address line 1')}}" value='{{$data->hasAddress->address_1}}'/>
                                @error('address_1')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Address line 2')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Address line 2')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address_2"
                                    class="form-control form-control-lg form-control-solid @error('address_2') is-invalid @enderror"
                                    placeholder="{{__('Address line 2')}}" value='{{$data->hasAddress->address_2}}'/>
                                @error('address_2')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('City')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('City')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="city"
                                    class="form-control form-control-lg form-control-solid @error('city') is-invalid @enderror"
                                    placeholder="{{__('City')}}" value='{{$data->hasAddress->city}}'/>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('State')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('State')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="state"
                                    class="form-control form-control-lg form-control-solid @error('state') is-invalid @enderror"
                                    placeholder="{{__('State')}}" value='{{$data->hasAddress->state}}'/>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Zip')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Zip')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="zip"
                                    class="form-control form-control-lg form-control-solid @error('zip') is-invalid @enderror"
                                    placeholder="{{__('Zip')}}" value='{{$data->hasAddress->zip}}'/>
                                @error('zip')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('ZIP+4')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('ZIP+4')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="zip_plus4"
                                    class="form-control form-control-lg form-control-solid @error('zip_plus4') is-invalid @enderror"
                                    placeholder="{{__('ZIP+4')}}" value='{{$data->hasAddress->zip_plus4}}'/>
                                @error('zip_plus4')
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
<script src="{{url('js/module/vendor-addresses.js')}}"></script>
@endsection