@extends('layouts.app')
@section('main-content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="false" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Scout Report</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('home')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Scout Report</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">List</li>
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
						<path opacity="0.3"
							d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
							fill="currentColor"></path>
						<path
							d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
							fill="currentColor"></path>
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
						<path opacity="0.3"
							d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
							fill="currentColor"></path>
						<path
							d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
							fill="currentColor"></path>
					</svg>
				</span>
				<div class="d-flex flex-column">
					<h4 class="mb-1 text-dark">Failed....!!!!</h4>
					<span>{{ $message }}</span>
				</div>
			</div>
			@endif
			<div class="card">
				<div class="card-header border-0 pt-6">
					<div class="card-title">
						<div class="d-flex align-items-center position-relative my-1">
							<span class="svg-icon svg-icon-1 position-absolute ms-6">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									fill="none">
									<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
										transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
									<path
										d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
										fill="currentColor" />
								</svg>
							</span>
							<input type="text" data-kt-customer-table-filter="search" name="data_tbl_search"
								class="form-control form-control-solid w-250px ps-15" placeholder="Search Type" />
						</div>
					</div>
					<div class="card-toolbar">
						{{-- <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
							<!--begin::Filter-->
							<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
								data-kt-menu-placement="bottom-end">
								<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
								<span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none">
										<path
											d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
											fill="black"></path>
									</svg>
								</span>
								<!--end::Svg Icon-->Filters
							</button>
							<!--begin::Menu 1-->
							<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
								<!--begin::Header-->
								<div class="px-7 py-5">
									<div class="fs-5 text-dark fw-bolder">Filter Options</div>
								</div>
								<div class="separator border-gray-200"></div>
								<div class="px-7 py-5" data-kt-user-table-filter="form">
									<!--begin::Input group-->
									<div class="mb-10">
										<label class="form-label fs-6 fw-bold">Commodity:</label>
										<select name="commodity_types" id="commodity_types" aria-label="Select a Commodity"  data-control="select2" data-placeholder="Select a Commodity..." class="form-select form-select-solid form-select-lg fw-bold">
											<option value="">Select a commodity...</option>
											@foreach($CropCommodities as $commodities)
											<option value="{{ $commodities->id }}">{{ $commodities->name }}</option>
											@endforeach
										</select>
									</div>
							
									<div class="mb-10">
										<label class="form-label fs-6 fw-bold">Scout Report Categories :</label>
										<select name="scout_report_category_id" id="scout_report_category_id" aria-label="Select a Location" data-control="select2" data-placeholder="Select a Scout Report Category..." class="form-select form-select-solid form-select-lg fw-bold">
											<option value="">Select a scout report category...</option>
											@foreach($ScoutReportCategories as $ScoutReportCategory)
											<option value="{{ $ScoutReportCategory->id }}">{{ $ScoutReportCategory->name }}</option>
											@endforeach
										</select>

									</div>
									<div class="mb-10">
										<label class="form-label fs-6 fw-bold">Status:</label>
										<select name="status" id="status" aria-label="Select Inspection Type" data-control="select2" data-placeholder="Select Inspection Type..." class="form-select form-select-solid form-select-lg fw-bold">
											<option value="">Select Status...</option>
											<option value="true">Active</option>
											<option value="false">De-Active</option>
										</select>
									</div>
									<div class="mb-10">
										<label class="form-label fs-6 fw-bold">Show Deleted:</label>
										<input
										class="form-check-input checkbox" 
										id="is_deleted_at"
										value="false"
										name="is_deleted_at" 
										type="checkbox"
										>
									</div>
									<div class="d-flex justify-content-end">
										<button type="reset"
											class="filter-clear-btn btn btn-light btn-active-light-primary fw-bold me-2 px-6"
											>Reset</button>
										<button type="submit" class="filter-apply-btn btn btn-primary fw-bold px-6"
											data-kt-menu-dismiss="true"
											data-kt-user-table-filter="filter">Apply</button>
									</div>
									<!--end::Actions-->
								</div>
								<!--end::Content-->
							</div>
							<!--end::Menu 1-->
							<!--end::Filter-->
						</div> --}}
					</div>
				</div>
				<div class="card-body pt-0">
					<table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTableList">
						<thead>
							<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
								<th class="min-w-125px">No.</th>
								<th class="min-w-125px">Customer</th>
								{{-- <th class="min-w-125px">Crop Commodity</th> --}}
								<th class="min-w-125px">Crop Location</th>
								<th class="min-w-125px">Date</th>
								<th class="text-end min-w-70px">Actions</th>
							</tr>
						</thead>
						<tbody class="fw-bold text-gray-600">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('pagespecificscripts')
<script>
	var listIndex = "{{ route('scout-reports.index') }}"
</script>
<script src="{{asset('js/module/scout-reports.js')}}"></script>
{{-- <script src="{{asset('js/custom_js/deleted_request.js')}}"></script> --}}
@endsection