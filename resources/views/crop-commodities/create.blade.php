@extends('layouts.app')
@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ __('Crop Commodities') }}</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('crop-commodities.index') }}"
                class="text-muted text-hover-primary">{{ __('Crop Commodities') }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ __('Add') }}</li>
    </ul>
@endsection
@section('main-content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            @include('layouts.errors')
            <div class="card mb-5 mb-xl-10">
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <form id="add_frm" name='add_frm' class="form" method="post"
                        action="{{ route('crop-commodities.store') }}">
                        @csrf
                        <div class="card-body border-top p-9">

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">{{ __('Crop Commodity Type') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ __('Crop Commodity Type') }}"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select
                                        class="form-select form-select-solid form-select-lg  @error('crop_commodity_type_id') is-invalid @enderror"
                                        id='crop_commodity_type_id' name="crop_commodity_type_id">
                                        <option value=''>{{ __('Select crop commodity type') }}</option>
                                        @if (!empty($CropCommodityTypes) && count($CropCommodityTypes) > 0)
                                            @foreach ($CropCommodityTypes as $CropCommodityType)
                                                <option value='{{ $CropCommodityType->id }}'
                                                    @if (old('crop_commodity_type_id') == $CropCommodityType->id) {{ 'selected' }} @endif>
                                                    {{ $CropCommodityType->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('crop_commodity_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span class="required">{{ __('Name') }}</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="{{ __('Name') }}"></i>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name"
                                            class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Name') }}" value='{{ old('name') }}' />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($questions as $question)
                                        @if ($question->getItemOptionAttributes->isNotEmpty())
                                            <div class="separator separator-dashed"></div>
                                            <div class="py-3" data-kt-customer-payment-method="row">
                                                <div class="py-3 d-flex flex-stack flex-wrap">
                                                    <div class="d-flex align-items-center collapsible rotate collapsed"
                                                        data-bs-toggle="collapse"
                                                        href="#kt_customer_view_payment_method_{{ $question->id }}"
                                                        role="button" aria-expanded="false"
                                                        aria-controls="kt_customer_view_payment_method_423">
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
                                                                    {{ $question->scout_report_category_name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="kt_customer_view_payment_method_{{ $question->id }}"
                                                    class="fs-6 ps-10 collapse {{ $question->scout_report_category_name }}"
                                                    style="">
                                                    <div class="d-flex flex-wrap py-5 question-list-wrapper">
                                                        <div class="form-group" style="width: 60%">
                                                            <div data-repeater-list="kt_docs_repeater_advanced">
                                                                <div data-repeater-item="" class="option-item-wrap">
                                                                    @if (count($question->getItemOptionAttributes) > 1)
                                                                        <div class="question_item_wrapper ">
                                                                            <div
                                                                                class="checkbox-wrapper form-group row mb-5  ">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-check">
                                                                                        <input
                                                                                            class="frm-checkbox form-check-input checkbox1"
                                                                                            type="checkbox"
                                                                                            name="question_attributes[]"
                                                                                            value=""
                                                                                            id="flexCheckDefault-{{ $question->id }}">
                                                                                        <label class="form-check-label"
                                                                                            for="flexCheckDefault-{{ $question->id }}">Select
                                                                                            All</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @foreach ($question->getItemOptionAttributes as $item)
                                                                        <div class="question_item_wrapper ">
                                                                            <div
                                                                                class="checkbox-wrapper form-group row mb-5  ">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-check">
                                                                                        <input
                                                                                            class="frm-checkbox form-check-input checked selected-check subcheck"
                                                                                            type="checkbox"
                                                                                            name="question_attributes_id[]"
                                                                                            value="{{ $item->id }}"
                                                                                            id="flexCheckDefault{{ $item->id }}">
                                                                                        <label class="form-check-label"
                                                                                            for="flexCheckDefault{{ $item->id }}">
                                                                                            {{ $item->label }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="reset"
                                        onclick="window.location='{{ route('crop-commodities.index') }}'"
                                        class="btn btn-light btn-active-light-primary me-2">{{ __('Cancel') }}</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="kt_account_profile_details_submit">{{ __('Save Changes') }}</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagespecificscripts')
    <script src="{{ url('js/module/crop-commodities.js') }}"></script>
@endsection
