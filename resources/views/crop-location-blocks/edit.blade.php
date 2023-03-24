@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('Crop Location Blocks')}}</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('Home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('crop-location-blocks.index')}}" class="text-muted text-hover-primary">{{__('Crop Location Blocks')}}</a>
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
                <form id="edit_frm" name='edit_frm' class="form" method="post"
                    action="{{ route('crop-location-blocks.update',$data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Crop Locations')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Crop Locations')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="crop_location_id add_scrin form-select form-select-solid form-select-lg  @error('crop_location_id') is-invalid @enderror"
                                    id='crop_location_id'  name="crop_location_id" data-control="select2">
                                    <option value=''>{{__('Select crop location')}}</option>
                                    @if (!empty($CropLocations) && count($CropLocations) > 0)
                                    @foreach ($CropLocations as $CropLocation)
                                    <option value='{{$CropLocation->id}}' @if ($data->crop_location_id==$CropLocation->id)
                                        {{'selected'}}
                                        @endif>{{$CropLocation->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('crop_location_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Crop Commodity')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Crop Commodity')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="crop_commodity_id add_scrin form-select form-select-solid form-select-lg  @error('crop_commodity_id') is-invalid @enderror"
                                    id='crop_commodity_id'  name="crop_commodity_id" data-control="select2">
                                    <option value=''>{{__('Select crop location')}}</option>
                                    @if (!empty($CropCommodities) && count($CropCommodities) > 0)
                                    @foreach ($CropCommodities as $CropCommodity)
                                    <option value='{{$CropCommodity->id}}' @if ($data->crop_commodity_id==$CropCommodity->id)
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
                                <span class="required">{{ __('Crop Commodity varities')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Crop commodities verity')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="crop_commodities_verity_id add_scrin form-select form-select-solid form-select-lg  @error('crop_commodities_verity_id') is-invalid @enderror"
                                    id='crop_commodities_verity_id'  name="crop_commodities_verity_id[]" data-placeholder="Select Crop Commoditiy Varities" multiple  data-control="select2">
                                    @foreach ($commodity_verities as $verity)    
                                    @if ($CropCommoditiesVarieties != null && in_array($verity->id,array_column($CropCommoditiesVarieties,'crop_commidties_verity_id')))
                                    <option value='{{ $verity->id }}' selected>{{ $verity->name }}</option>
                                    @else
                                    <option value='{{ $verity->id }}'>{{ $verity->name }}</option>
                                    @endif
                                    @endforeach
                                </select>  @error('crop_commodities_verity_id')
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
                                    placeholder="{{__('Name')}}" value='{{$data->name}}' />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Acres')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Acres')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="acres"
                                    class="form-control form-control-lg form-control-solid @error('acres') is-invalid @enderror"
                                    placeholder="{{__('Acres')}}" value='{{$data->acres}}' />
                                @error('acres')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Year Planted')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Year Planted')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="year_planted"
                                    class="form-control form-control-lg form-control-solid @error('year_planted') is-invalid @enderror"
                                    placeholder="{{__('Year Planted')}}" value='{{$data->year_planted}}' />
                                @error('year_planted')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Plant Feet Spacing In Rows')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Plant Feet Spacing In Rows')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="plant_feet_spacing_in_rows"
                                    class="form-control form-control-lg form-control-solid @error('plant_feet_spacing_in_rows') is-invalid @enderror"
                                    placeholder="{{__('Plant Feet Spacing In Rows')}}" value='{{$data->plant_feet_spacing_in_rows}}' />
                                @error('plant_feet_spacing_in_rows')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Plant Feet Between Rows')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Plant Feet Between Rows')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="plant_feet_between_rows"
                                    class="form-control form-control-lg form-control-solid @error('plant_feet_between_rows') is-invalid @enderror"
                                    placeholder="{{__('Plant Feet Between Rows')}}" value='{{$data->plant_feet_between_rows}}' />
                                @error('plant_feet_between_rows')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="">{{__('Description')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{__('Description')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <textarea data-kt-autosize="true" name="description"
                                    class="form-control form-control-lg form-control-solid @error('description') is-invalid @enderror"
                                    placeholder="{{__('Description')}}">{{$data->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" onclick="window.location='{{ route('crop-location-blocks.index') }}'"
                            class="btn btn-light btn-active-light-primary me-2">{{__('Cancel')}}</button>
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
<script src="{{url('js/module/crop-location-blocks.js')}}"></script>
@endsection