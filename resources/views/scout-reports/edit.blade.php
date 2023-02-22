@extends('layouts.app')
@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ __('Scout Reports') }}</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('scout-reports.index') }}" class="text-muted text-hover-primary">{{ __('Scout Reports') }}</a>
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
                    <div class="card card-flush py-4 flex-row-fluid">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-bold text-gray-600">
                                        <tr>
                                            <td class="info-td d-flex">
                                                <div class=" align-items-left col-form-label fw-bold fs-6">
                                                    {{ __('Grower Name') }} : </div>
                                                <div class="text-muted col-form-label ms-1 info-td fw-bolder text-start">
                                                    {{ $ScoutReport->hasCustomer->name }} </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="info-td d-flex">
                                                <div class=" align-items-left col-form-label fw-bold fs-6">
                                                    {{ __('Date') }} : </div>
                                                <div class="text-muted col-form-label ms-1 info-td fw-bolder text-start">
                                                    {{ $ScoutReport->date_formatted }} </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="info-td d-flex">
                                                <div class=" align-items-left col-form-label fw-bold fs-6">
                                                    {{ __('Ranch Name') }} : </div>
                                                <div class="text-muted col-form-label ms-1 info-td fw-bolder text-start">
                                                    {{ $ScoutReport->hasCropLocation->name }} </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="info-td d-flex">
                                                <div class=" align-items-left col-form-label fw-bold fs-6">
                                                    {{ __('Ranch Block Names') }} : </div>
                                                <div class="text-muted col-form-label ms-1 info-td fw-bolder text-start">
                                                    @php
                                                        $str = [];
                                                    @endphp
                                                    @if (!empty($ScoutReport->has_crop_location_blocks) && $ScoutReport->has_crop_location_blocks != null)
                                                        @foreach ($ScoutReport->has_crop_location_blocks as $blocks)
                                                            @php
                                                                $str[] = $blocks->name;
                                                            @endphp
                                                        @endforeach
                                                        @if (!empty($str))
                                                            {{ implode(', ', $str) }}
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="info-td d-flex">
                                                <div class=" align-items-left col-form-label fw-bold fs-6">
                                                    {{ __('Commodities') }} : </div>
                                                <div class="text-muted col-form-label ms-1 info-td fw-bolder text-start">
                                                    @php
                                                        $commodity_str = [];
                                                    @endphp
                                                    @if (!empty($ScoutReport->has_crop_commodities) && $ScoutReport->has_crop_commodities != null)
                                                        @foreach ($ScoutReport->has_crop_commodities as $commodity)
                                                            @php
                                                                $commodity_str[] = $commodity->name;
                                                            @endphp
                                                        @endforeach
                                                        @if (!empty($commodity_str))
                                                            {{ implode(', ', $commodity_str) }}
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 mb-xl-10">
                <div id="kt_account_settings_profile_details" class="collapse show">
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
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if (!empty($ScoutQuestionItem) && $ScoutQuestionItem != null)
                                @foreach ($ScoutQuestionItem as $question)
                                    <form id="edit_item_form" class="form edit-question-form" method="post" action=""
                                        novalidate="novalidate">
                                        @csrf
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
                                                <div class="d-flex my-3 ms-9"
                                                    style="width: 40%;
                                                    justify-content: end; align-items: center;">
                                                    <a href="javascript:void(0);"
                                                        class="edit-btn btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                            aria-label="Edit" data-kt-initialized="1">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3"
                                                                        d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 
                                                                            2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 
                                                                            1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 
                                                                            21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 
                                                                            21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 
                                                                            14.109L2.06399 20.309C1.98815 20.5354 1.97703 
                                                                            20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 
                                                                            21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 
                                                                            21.9115 2.989 21.9658C3.22158 22.0201 3.4647 
                                                                            22.0084 3.69099 21.932H3.68699Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 
                                                                            2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 
                                                                            21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 
                                                                            20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 
                                                                            21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 
                                                                            4.75098L4.13499 14.105Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="kt_customer_view_payment_method_{{ $question->id }}"
                                                class="fs-6 ps-10 collapse"
                                                data-bs-parent="#kt_customer_view_payment_method" style="">
                                                <div class="d-flex flex-wrap py-5 question-list-wrapper">
                                                    <div class="form-group" style="width: 60%">
                                                        <div data-repeater-list="kt_docs_repeater_advanced">
                                                            <div data-repeater-item="" class="option-item-wrap">
                                                                @php
                                                                    if ($answers->where('scout_question_item_id', $question->id)->isNotEmpty()) {
                                                                        $Answer = $answers->where('scout_question_item_id', $question->id)->first();
                                                                    } else {
                                                                        $Answer = null;
                                                                    }
                                                                    
                                                                    if ($Answer != null) {
                                                                        $comments = $Answer->comment;
                                                                        $scout_answer_report_id = $Answer->id;
                                                                    } else {
                                                                        $comments = '';
                                                                        $scout_answer_report_id = 'new';
                                                                    }
                                                                @endphp
                                                                <input type='hidden' name='scout_answer_report_id'
                                                                    value='{{ $scout_answer_report_id }}'>
                                                                <input type='hidden' name='scout_report_id'
                                                                    value='{{ $ScoutReport->id }}'>
                                                                <input type="hidden" name="scout_question_item_id"
                                                                    value="{{ $question->id }}">
                                                                @if ($question->getScoutItemOptionAttributes->isNotEmpty())
                                                                    @foreach ($question->getScoutItemOptionAttributes as $options)
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-md-12">
                                                                                <div class="form-check">
                                                                                    @php
                                                                                        if ($Answer != null && $Answer->hasScoutAnswerReportItem->where('scout_question_item_attribute_id', $options->id)->isNotEmpty()) {
                                                                                            $Answer_opt = $Answer->hasScoutAnswerReportItem->where('scout_question_item_attribute_id', $options->id)->first();
                                                                                        } else {
                                                                                            $Answer_opt = null;
                                                                                        }
                                                                                        if ($Answer_opt != null) {
                                                                                            $item_option_answerd = $Answer_opt->scout_question_item_attribute_id;
                                                                                            $ques_check = 'checked';
                                                                                        } else {
                                                                                            $item_option_answerd = null;
                                                                                            $ques_check = '';
                                                                                        }
                                                                                    @endphp
                                                                                    <input
                                                                                        class="frm-checkbox form-check-input no_prior_event_observed_checkbox"
                                                                                        type="checkbox"
                                                                                        name="scout_options[]"
                                                                                        value="{{ $options->id }}"
                                                                                        id="flexCheckDefault{{ $options->id }}"
                                                                                        {{ $ques_check }} disabled>
                                                                                    <label class="form-check-label"
                                                                                        for="flexCheckDefault{{ $options->id }}">{{ $options->label }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <textarea data-kt-autosize="true" name="comment"
                                                                            class="form-control form-control-lg form-control-solid @error('comment') is-invalid @enderror"
                                                                            placeholder="{{ __('Comments') }}" disabled>{{ $comments }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="edit-wrapper d-flex justify-content-end py-6 px-9 d-none">
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
            align-items: flex-start;
        }

        .option_value_persent {
            display: none;
        }

        td.info-td {
            padding: 0 !important;
        }
    </style>
@endsection
@section('pagespecificscripts')
    <script src="{{ asset('js/module/scout-reports.js') }}"></script>
@endsection
