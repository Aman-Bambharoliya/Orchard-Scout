@extends('layouts.app')
@section('main-content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Questions</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('home')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Questions</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Add Question</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            @if ($message = Session::get('success'))
            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-success me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                    </svg>
                </span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-dark">Success....!!!!</h4>
                    <span>{{ $message }}</span>
                </div>
            </div>
            @elseif ($message = Session::get('error'))
            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-danger me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                    </svg>
                </span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-dark">Failed....!!!!</h4>
                    <span>{{ $message }}</span>
                </div>
            </div>
            @endif
            <div class="card mb-5 mb-xl-10">
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <form id="add_item_form" class="form" method="post" action="{{route('questions.store')}}">
                        @csrf
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Commodity Type</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Commodity Type"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select name="vehicle_types[]" aria-label="Select a Commodity Type" multiple="multiple" data-control="select2" data-placeholder="Select a Vehicles..." class="form-select form-select-solid form-select-lg fw-bold">
                                        <option value="">Select a commodity...</option>
                                        @foreach($CropCommodities as $commodities)
                                        <option value="{{ $commodities->id }}">{{ $commodities->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Scout Report Categories</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Inspection Location"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select name="inspection_location_id" id="location_id" aria-label="Select a Location" data-control="select2" data-placeholder="Select a Scout Report Category..." class="form-select form-select-solid form-select-lg fw-bold">
                                        <option value="">Select a scout report category...</option>
                                        @foreach($ScoutReportCategories as $ScoutReportCategory)
                                        <option value="{{ $ScoutReportCategory->id }}">{{ $ScoutReportCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Item Name</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Name of Item"></i>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Item Name" />
                                </div>
                            </div>
                              <div id="kt_docs_repeater_advanced">
                                <div class="form-group">
                                    <div data-repeater-list="kt_docs_repeater_advanced">
                                        <div data-repeater-item>
                                            <div class="form-group row mb-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Parent Input Option</label>
                                                    <select name="parent_input_option" class="form-select form-select-solid form-select-lg fw-bold parent_input_option" data-kt-repeater="select2" data-placeholder="Select an option">
                                                        <option value="">Select a Option...</option>
                                                        <option value="1">Checkbox</option>
                                                        <option value="2">TextBox</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Input Label Name</label>
                                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid text-required-box" placeholder="Input Label" />
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                        <i class="la la-trash-o fs-3"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="radio-option" style="display:none">
                                                <div class="form-group row mb-5">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Input Label Name</label>
                                                        <input type="text" name="option_label" class="form-control form-control-lg form-control-solid check-required" placeholder="Input Label" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Wholesale percent deduction</label>
                                                        <input type="text" name="option_value_wholesale" class="form-control form-control-lg form-control-solid number_validation check-required" placeholder="Wholesale percent deduction" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Retail percent deduction</label>
                                                        <input type="text" name="option_value_retail" class="form-control form-control-lg form-control-solid number_validation check-required" placeholder="Retail percent deduction" />
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-5">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Input Label Name</label>
                                                        <input type="text" name="option_label2" class="form-control form-control-lg form-control-solid check-required" placeholder="Input Label" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Wholesale percent deduction</label>
                                                        <input type="text" name="option_value2_wholesale" class="form-control form-control-lg form-control-solid number_validation check-required"  placeholder="Wholesale percent deduction" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Retail percent deduction</label>
                                                        <input type="text" name="option_value2_retail" class="form-control form-control-lg form-control-solid number_validation check-required" placeholder="Retail percent deduction" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                        <i class="la la-plus"></i>Add
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script>
	var locationTypeIndex = "{{ url('get-inspection-types') }}"
</script>
<script src="{{asset('js/custom_js/inspection_item_register.js')}}"></script>
@endsection