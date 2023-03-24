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
                                                            @php
                                                                $commodity_name = array_unique($commodity_str);
                                                            @endphp
                                                            {{ implode(',', $commodity_name) }}
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
                            <form data-form_type="notes" id="edit_item_form" class="form edit-question-form notes-box"
                                method="post" action="" novalidate="novalidate">
                                @csrf
                                <input type='hidden' name='scout_report_id' value='{{ $ScoutReport->id }}'>
                                <div class="row mb-6 ms-5 form-group">
                                    <label class="col-lg-1 col-form-label fw-bold fs-6">
                                        <span class="">{{ __('Notes') }}</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="{{ __('Notes') }}"></i>
                                    </label>
                                    <div class="col-lg-10 fv-row">
                                        <textarea data-kt-autosize="true" name="notes"
                                            class="text-muted form-control form-control-lg form-control-solid @error('notes') is-invalid @enderror"
                                            placeholder="{{ __('Notes') }}" disabled data-old_val="{{ $ScoutReport->notes }}">{{ $ScoutReport->notes }}</textarea>
                                        @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 fv-row d-flex" style="justify-content: end; align-items: center;">
                                        <div class="edit-icon-wrapper d-flex">
                                            <a href="javascript:void(0);"
                                                class="edit-btn btn btn-icon btn-active-light-primary w-25px h-25px me-3"
                                                title="{{ __('Edit') }}" data-bs-toggle="tooltip"
                                                data-edit_type='notes'>
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" aria-label="Edit"
                                                    data-kt-initialized="1">

                                                    <span class="svg-icon svg-icon-primary svg-icon-2qx"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                                fill="currentColor" />
                                                        </svg></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class='action-btn-wrapper d-flex d-none'>
                                            <button type="submit"
                                                class="btn btn-icon btn-active-success w-25px h-25px me-3" id=""
                                                data-update_type='notes'>
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" aria-label="Edit"
                                                    data-kt-initialized="1" title="{{ __('Save Changes') }}"
                                                    data-bs-toggle="tooltip">
                                                    <span class="svg-icon svg-icon-2qx svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2"
                                                                width="20" height="20" rx="5"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </span>
                                            </button>
                                            <button type="button"
                                                class="btn btn-icon btn-active-danger w-25px h-25px me-3  edit-cancel"
                                                id="asdasdasd" title="{{ __('Cancel Changes') }}"
                                                data-bs-toggle="tooltip" data-cancel_type='notes'>
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" aria-label="Edit"
                                                    data-kt-initialized="1">
                                                    <span class="svg-icon svg-icon-2qx svg-icon-danger"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2"
                                                                width="20" height="20" rx="5"
                                                                fill="currentColor" />
                                                            <rect x="7" y="15.3137" width="12"
                                                                height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                            <rect x="8.41422" y="7" width="12"
                                                                height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                        </svg></span>
                                                    </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if (!empty($ScoutQuestionItem) && $ScoutQuestionItem != null)
                                @foreach ($ScoutQuestionItem as $question)
                                    <form data-form_type="questions" id="edit_item_form" class="form edit-question-form"
                                        method="post" action="" novalidate="novalidate">
                                        @csrf
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
                                            
                                            if ((isset($Answer->hasScoutAnswerReportItem) && $Answer->hasScoutAnswerReportItem->isEmpty() == false) || ($comments != '' || $comments != null)) {
                                                $ques_cls = '';
                                                $empty_cls = 'd-none';
                                                $tab_head_cls = 'active';
                                                $tab_body_cls = 'show';
                                            } else {
                                                $ques_cls = 'd-none';
                                                $empty_cls = '';
                                                $tab_head_cls = 'collapsed';
                                                $tab_body_cls = '';
                                            }
                                            if ($comments != '') {
                                                $cmt_shw_cls = '';
                                            } else {
                                                $cmt_shw_cls = 'd-none';
                                            }
                                        @endphp
                                        <div class="py-0" data-kt-customer-payment-method="row">
                                            <div class="py-3 d-flex flex-stack flex-wrap">
                                                <div class="d-flex align-items-center collapsible rotate {{ $tab_head_cls }}"
                                                    data-bs-toggle="collapse"
                                                    href="#kt_customer_view_payment_method_{{ $question->id }}"
                                                    role="button" aria-expanded="true"
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
                                                    <div class="edit-icon-wrapper d-flex">
                                                        <a href="javascript:void(0);"
                                                            class="edit-btn btn btn-icon btn-active-light-primary w-25px h-25px me-3"
                                                            title="{{ __('Edit') }}" data-bs-toggle="tooltip"
                                                            data-edit_type='questions'>
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                aria-label="Edit" data-kt-initialized="1">

                                                                <span class="svg-icon svg-icon-primary svg-icon-2qx"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <path opacity="0.3" fill-rule="evenodd"
                                                                            clip-rule="evenodd"
                                                                            d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                                            fill="currentColor" />
                                                                        <path
                                                                            d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                                            fill="currentColor" />
                                                                        <path
                                                                            d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                                            fill="currentColor" />
                                                                    </svg></span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class='action-btn-wrapper d-flex d-none'>
                                                        <button type="submit"
                                                            class="btn btn-icon btn-active-success w-25px h-25px me-3"
                                                            id="" data-update_type='questions'>
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                aria-label="Edit" data-kt-initialized="1"
                                                                title="{{ __('Save Changes') }}"
                                                                data-bs-toggle="tooltip">
                                                                <span class="svg-icon svg-icon-2qx svg-icon-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <rect opacity="0.3" x="2"
                                                                            y="2" width="20" height="20"
                                                                            rx="5" fill="currentColor" />
                                                                        <path
                                                                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-danger w-25px h-25px me-3  edit-cancel"
                                                            id="asdasdasd" title="{{ __('Cancel Changes') }}"
                                                            data-bs-toggle="tooltip" data-cancel_type='questions'>
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                aria-label="Edit" data-kt-initialized="1">
                                                                <span class="svg-icon svg-icon-2qx svg-icon-danger"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <rect opacity="0.3" x="2"
                                                                            y="2" width="20" height="20"
                                                                            rx="5" fill="currentColor" />
                                                                        <rect x="7" y="15.3137"
                                                                            width="12" height="2" rx="1"
                                                                            transform="rotate(-45 7 15.3137)"
                                                                            fill="currentColor" />
                                                                        <rect x="8.41422" y="7"
                                                                            width="12" height="2" rx="1"
                                                                            transform="rotate(45 8.41422 7)"
                                                                            fill="currentColor" />
                                                                    </svg></span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="kt_customer_view_payment_method_{{ $question->id }}"
                                                class="fs-6 ps-10 collapse {{ $tab_body_cls }}" style="">
                                                <div class="d-flex flex-wrap py-5 question-list-wrapper">
                                                    <div class="form-group" style="width: 60%">
                                                        <div data-repeater-list="kt_docs_repeater_advanced">
                                                            <div data-repeater-item="" class="option-item-wrap">
                                                                <div class="question_item_wrapper {{ $ques_cls }}">
                                                                    <input type='hidden' name='scout_answer_report_id'
                                                                        value='{{ $scout_answer_report_id }}'>
                                                                    <input type='hidden' name='scout_report_id'
                                                                        value='{{ $ScoutReport->id }}'>
                                                                    <input type="hidden" name="scout_question_item_id"
                                                                        value="{{ $question->id }}">
                                                                    @if ($question->getScoutItemOptionAttributes->isNotEmpty())
                                                                        @foreach ($question->getScoutItemOptionAttributes as $options)
                                                                            @php
                                                                                if ($Answer != null && $Answer->hasScoutAnswerReportItem->where('scout_question_item_attribute_id', $options->id)->isNotEmpty()) {
                                                                                    $Answer_opt = $Answer->hasScoutAnswerReportItem->where('scout_question_item_attribute_id', $options->id)->first();
                                                                                } else {
                                                                                    $Answer_opt = null;
                                                                                }
                                                                                if ($Answer_opt != null) {
                                                                                    $item_option_answerd = $Answer_opt->scout_question_item_attribute_id;
                                                                                    $ques_check = 'checked selected-check';
                                                                                } else {
                                                                                    $item_option_answerd = null;
                                                                                    $ques_check = 'not-selected-check';
                                                                                }
                                                                            @endphp
                                                                            <div
                                                                                class="checkbox-wrapper form-group row mb-5 @if ($Answer_opt != null) @else {{ 'd-none' }} @endif">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-check">
                                                                                        <input
                                                                                            class="frm-checkbox form-check-input {{ $ques_check }}"
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
                                                                    <div
                                                                        class="comment-box-wrapper form-group row mb-5 {{ $cmt_shw_cls }}">
                                                                        <div class="col-md-12">
                                                                            <textarea data-kt-autosize="true" name="comment"
                                                                                class="form-control form-control-lg form-control-solid @error('comment') is-invalid @enderror"
                                                                                placeholder="{{ __('Comments') }}" disabled data-old_val="{{ $comments }}">{{ $comments }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="empty_answer_wrapper {{ $empty_cls }}">
                                                                    <h4>Nothing Reported</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
