@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('Crop Commodity Varieties')}}</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('Home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('crop-commodity-varieties.index')}}" class="text-muted text-hover-primary">{{__('Crop Commodity Varieties')}}</a>
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
                <form id="add_frm" name='add_frm' class="form" method="post" action="{{ route('crop-commodity-varieties.update',$data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Crop Commodity')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Crop Commodity')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="form-select form-select-solid form-select-lg  @error('crop_commodity_id') is-invalid @enderror"
                                    id='crop_commodity_id' name="crop_commodity_id">
                                    <option value=''>Select crop commodity</option>
                                    @if (!empty($CropCommodities) && count($CropCommodities) > 0)
                                    @foreach ($CropCommodities as $CropCommodity)
                                        <option value='{{$CropCommodity->id}}' @if($data->crop_commodity_id==$CropCommodity->id)
                                            {{'selected'}}
                                        @endif>{{$CropCommodity->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('crop_commodity_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{__('Name')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Name')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name"
                                    class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                    placeholder="{{__('Name')}}" value='{{$data->name}}'/>
                                @error('name')
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
<script src="{{url('js/module/crop-commodity-varieties.js')}}"></script>
@endsection