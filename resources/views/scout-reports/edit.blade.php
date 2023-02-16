@extends('layouts.app')
@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ __('Scout Report Categories') }}</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('scout-report-categories.index') }}"
                class="text-muted text-hover-primary">{{ __('Scout Report Categories') }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Edit') }}</li>
    </ul>
@endsection
@section('main-content')
    <div class="post d-flex flex-column-fluid" id="kt_post" style=''>
        <div id="kt_content_container" class="container-xxl">
            @include('layouts.errors')
            <div class="card mb-5 mb-xl-10">
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <form id="edit_frm" name='edit_frm' class="form" method="post"
                        action="{{ route('scout-reports.update', $ScoutReport->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">{{ __('Customers') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('Crop Locations') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select
                                        class="crop_location_id add_scrin form-select form-select-solid form-select-lg  @error('customer_id') is-invalid @enderror"
                                        id='customer_id' name="customer_id" data-control="select2">
                                        <option value=''>{{ __('Select Customer') }}</option>
                                        @if (!empty($Customer) && count($Customer) > 0)
                                            @foreach ($Customer as $user)
                                                <option value='{{ $user->id }}'
                                                    @if ($ScoutReport->crop_location_id == $user->id) {{ 'selected' }} @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">{{ __('Crop Location') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('Crop Location') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select
                                        class="crop_location_id add_scrin form-select form-select-solid form-select-lg  @error('crop_location_id') is-invalid @enderror"
                                        id='crop_location_id' name="crop_location_id" data-control="select2">
                                        <option value=''>{{ __('Select crop location') }}</option>

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
                                    <span class="required">{{ __('Crop Location Block') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('Crop Location Block') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select
                                        class="crop_location_block_id add_scrin form-select form-select-solid form-select-lg  @error('crop_location_block_id') is-invalid @enderror"
                                        id='crop_location_block_id' name="crop_location_block_id" data-control="select2">
                                        <option value=''>{{ __('Select crop location block') }}</option>

                                    </select>
                                    @error('crop_location_block_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">{{ __('Crop Commodity') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('Crop Commodity') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select
                                        class="crop_commodity_id add_scrin form-select form-select-solid form-select-lg  @error('crop_commodity_id') is-invalid @enderror"
                                        id='crop_commodity_id' name="crop_commodity_id" data-control="select2">
                                        <option value=''>{{ __('Select crop location') }}</option>
                                        @if (!empty($CropCommodities) && count($CropCommodities) > 0)
                                            @foreach ($CropCommodities as $CropCommodity)
                                                <option value='{{ $CropCommodity->id }}'
                                                    @if ($ScoutReport->crop_commodity_id == $CropCommodity->id) {{ 'selected' }} @endif>
                                                    {{ $CropCommodity->name }}</option>
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
                            {{-- <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">{{ __('Crop Location')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Crop Location')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select
                                    class="crop_location_id add_scrin form-select form-select-solid form-select-lg  @error('crop_location_id') is-invalid @enderror"
                                    id='crop_location_id'  name="crop_location_id" data-control="select2">
                                    <option value=''>{{__('Select crop location')}}</option>
                                </select>
                                @error('crop_location_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div> --}}
                            {{-- <div class="row mb-6">
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
                        </div> --}}
                            {{-- <div class="row mb-6">
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
                        </div> --}}
                            {{-- <div class="row mb-6">
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
                        </div> --}}
                            {{-- <div class="row mb-6">
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
                        </div> --}}
                            {{-- <div class="row mb-6">
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
                        </div> --}}
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="">{{ __('General Comments') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('General Comments') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <textarea data-kt-autosize="true" name="general_comments"
                                        class="form-control form-control-lg form-control-solid @error('general_comments') is-invalid @enderror"
                                        placeholder="{{ __('General Comments') }}">{{ $ScoutReport->general_comments }}</textarea>
                                    @error('general_comments')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset"
                                class="btn btn-light btn-active-light-primary me-2">{{ __('Discard') }}</button>
                            <button type="submit" class="btn btn-primary"
                                id="kt_account_profile_details_submit">{{ __('Save
                                                                                                                                                                                            Changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-5 mb-xl-10">
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <input type="hidden" name="vehicle_wholesale_value" value="150000.00">
                    <input type="hidden" name="vehicle_retail_value" value="180000.00">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div id="kt_customer_view_payment_method" class="card-body pt-0">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="">{{ __('Notes') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('Notes') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <textarea data-kt-autosize="true" name="notes"
                                        class="form-control form-control-lg form-control-solid @error('notes') is-invalid @enderror"
                                        placeholder="{{ __('Notes') }}">{{ $ScoutReport->notes }}</textarea>
                                    @error('general_comments')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if (!empty($ScoutQuestionItem) && $ScoutQuestionItem != null)
                                @foreach ($ScoutQuestionItem as $question)
                                    <form id="edit_item_form" class="form edit-question-form" method="post"
                                        action="" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="py-0" data-kt-customer-payment-method="row">
                                            <div class="py-3 d-flex flex-stack flex-wrap">
                                                <div class="d-flex align-items-center collapsible rotate collapsed"
                                                    data-bs-toggle="collapse"
                                                    href="#kt_customer_view_payment_method_{{ $question->id }}"
                                                    role="button" aria-expanded="false"
                                                    aria-controls="kt_customer_view_payment_method_{{ $question->id }}">
                                                    <div class="me-3 rotate-90">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 
                                                            8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 
                                                            18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 
                                                            11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 
                                                            5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 
                                                            11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-gray-800 fw-bold">
                                                                {{ $question->hasScoutReportCategory->name }}</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="kt_customer_view_payment_method_{{ $question->id }}"
                                                class="fs-6 ps-10 collapse"
                                                data-bs-parent="#kt_customer_view_payment_method" style="">
                                                <div class="d-flex flex-wrap py-5 question-list-wrapper">
                                                    <div class="form-group" style="width: 60%">
                                                        <div data-repeater-list="kt_docs_repeater_advanced">
                                                            <div data-repeater-item="" class="option-item-wrap">
                                                                @if ($question->getScoutItemOptionAttributes->isNotEmpty())
                                                                    @foreach ($question->getScoutItemOptionAttributes as $option)
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-md-12">
                                                                                <div class="form-check">
                                                                                    {{-- <input type="hidden"
                                                                                    name="vehicle_answer_report_id"
                                                                                    value="54">
                                                                                <input type="hidden" name="vehicle_id"
                                                                                    value="10">
                                                                                <input type="hidden"
                                                                                    name="inspection_item_id" value="9"> --}}
                                                                                    <input
                                                                                        class="frm-checkbox form-check-input no_prior_event_observed_checkbox"
                                                                                        type="checkbox"
                                                                                        name="no_prior_event_observed"
                                                                                        value="true"
                                                                                        id="flexCheckDefault9">
                                                                                    <label class="form-check-label"
                                                                                        for="flexCheckDefault9">{{ $option->label }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <textarea data-kt-autosize="true" name="general_comments"
                                                                            class="form-control form-control-lg form-control-solid @error('general_comments') is-invalid @enderror"
                                                                            placeholder="{{ __('General Comments') }}">{{ $ScoutReport->general_comments }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="edit-wrapper d-flex justify-content-end py-6 px-9">
                                                    <button type="reset"
                                                        class="btn btn-light btn-active-light-primary me-2 edit-cancel">Discard</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="kt_account_profile_details_submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagespecificstyles')
    <style>
        .vehicle-info-stickey-wrapper {
            /* flex-direction: column; */
            align-items: flex-start;
        }

        .option_value_persent {
            display: none;
        }
    </style>
@endsection
@section('pagespecificscripts')
    <script src="{{ asset('js/module/scout-reports.js') }}"></script>
@endsection
{{-- ################################################################################################################################################################################################################################################################################################## --}}
