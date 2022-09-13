@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard</h1>
@endsection
@section('main-content')
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			@include('layouts.errors')
			<div class="row g-5 g-xl-8">
				<div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
							<span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor"></rect>
									<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor"></rect>
									<rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor"></rect>
									<rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor"></rect>
								</svg>
							</span>
							<!--end::Svg Icon-->
							<div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">500</div>
							<div class="fw-bold text-gray-400">New Reports Ordered</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>
				<div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
							<span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path>
									<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path>
									<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path>
								</svg>
							</span>
							<!--end::Svg Icon-->
							<div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">+3000</div>
							<div class="fw-bold text-gray-100">New Customers</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>
				<div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
							<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor"></path>
									<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor"></path>
								</svg>
							</span>
							<!--end::Svg Icon-->
							<div class="text-white fw-bolder fs-2 mb-2 mt-5">$50,000</div>
							<div class="fw-bold text-white">Milestone Reached</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>
				<div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
							<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
									<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
								</svg>
							</span>
							<!--end::Svg Icon-->
							<div class="text-white fw-bolder fs-2 mb-2 mt-5">$50,000</div>
							<div class="fw-bold text-white">Milestone Reached</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>
			</div>		
			<!--begin::Row-->
			<div class="row gy-5 g-xl-10">
				<!--begin::Col-->
				<div class="col-xl-12 mb-5 mb-xl-10">
					<!--begin::Table Widget 4-->
					<div class="card card-flush h-xl-100">
						<!--begin::Card header-->
						<div class="card-header pt-7">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-gray-800">Product Orders</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Avg. 57 orders per day</span>
							</h3>
							<!--end::Title-->
							<!--begin::Actions-->
							<div class="card-toolbar">
								<!--begin::Filters-->
								<div class="d-flex flex-stack flex-wrap gap-4">
									<!--begin::Destination-->
									<div class="d-flex align-items-center fw-bolder">
										<!--begin::Label-->
										<div class="text-gray-400 fs-7 me-2">Cateogry</div>
										<!--end::Label-->
										<!--begin::Select-->
										<select class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
											<option></option>
											<option value="Show All" selected="selected">Show All</option>
											<option value="a">Category A</option>
											<option value="b">Category A</option>
										</select>
										<!--end::Select-->
									</div>
									<!--end::Destination-->
									<!--begin::Status-->
									<div class="d-flex align-items-center fw-bolder">
										<!--begin::Label-->
										<div class="text-gray-400 fs-7 me-2">Status</div>
										<!--end::Label-->
										<!--begin::Select-->
										<select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
											<option></option>
											<option value="Show All" selected="selected">Show All</option>
											<option value="Shipped">Shipped</option>
											<option value="Confirmed">Confirmed</option>
											<option value="Rejected">Rejected</option>
											<option value="Pending">Pending</option>
										</select>
										<!--end::Select-->
									</div>
									<!--end::Status-->
									<!--begin::Search-->
									<div class="position-relative my-1">
										<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
										<span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
												<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search" />
									</div>
									<!--end::Search-->
								</div>
								<!--begin::Filters-->
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-2">
							<!--begin::Table-->
							<table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
								<!--begin::Table head-->
								<thead>
									<!--begin::Table row-->
									<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
										<th class="min-w-100px">Order ID</th>
										<th class="text-end min-w-100px">Created</th>
										<th class="text-end min-w-125px">Customer</th>
										<th class="text-end min-w-100px">Total</th>
										<th class="text-end min-w-100px">Profit</th>
										<th class="text-end min-w-50px">Status</th>
										<th class="text-end"></th>
									</tr>
									<!--end::Table row-->
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody class="fw-bolder text-gray-600">
									<tr data-kt-table-widget-4="subtable_template" class="d-none">
										<td colspan="2">
											<div class="d-flex align-items-center gap-3">
												<a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
													<img src="" data-kt-src-path="theme/media/stock/ecommerce/" alt="" data-kt-table-widget-4="template_image" />
												</a>
												<div class="d-flex flex-column text-muted">
													<a href="#" class="text-gray-800 text-hover-primary fw-bolder" data-kt-table-widget-4="template_name">Product name</a>
													<div class="fs-7" data-kt-table-widget-4="template_description">Product description</div>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="text-gray-800 fs-7">Cost</div>
											<div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_cost">1</div>
										</td>
										<td class="text-end">
											<div class="text-gray-800 fs-7">Qty</div>
											<div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_qty">1</div>
										</td>
										<td class="text-end">
											<div class="text-gray-800 fs-7">Total</div>
											<div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_total">name</div>
										</td>
										<td class="text-end">
											<div class="text-gray-800 fs-7 me-3">On hand</div>
											<div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_stock">32</div>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGY-346</a>
										</td>
										<td class="text-end">7 min ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Albert Flores</a>
										</td>
										<td class="text-end">$630.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$86.70</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#YHD-047</a>
										</td>
										<td class="text-end">52 min ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Jenny Wilson</a>
										</td>
										<td class="text-end">$25.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$4.20</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SRR-678</a>
										</td>
										<td class="text-end">1 hour ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Robert Fox</a>
										</td>
										<td class="text-end">$1,630.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$203.90</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#PXF-534</a>
										</td>
										<td class="text-end">3 hour ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Cody Fisher</a>
										</td>
										<td class="text-end">$119.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$12.00</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGD-249</a>
										</td>
										<td class="text-end">2 day ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Arlene McCoy</a>
										</td>
										<td class="text-end">$660.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$52.26</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SKP-035</a>
										</td>
										<td class="text-end">2 day ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Eleanor Pena</a>
										</td>
										<td class="text-end">$290.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$29.00</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SKP-567</a>
										</td>
										<td class="text-end">7 min ago</td>
										<td class="text-end">
											<a href="#" class="text-gray-600 text-hover-primary">Dan Wilson</a>
										</td>
										<td class="text-end">$590.00</td>
										<td class="text-end">
											<span class="text-gray-800 fw-boldest">$50.00</span>
										</td>
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
										</td>
										<td class="text-end">
											<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-off">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
												<span class="svg-icon svg-icon-3 m-0 toggle-on">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
										</td>
									</tr>
								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Table Widget 4-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Row-->
			<div class="row gy-5 g-xl-10">
				<!--begin::Col-->
				<div class="col-xl-12">
					<!--begin::Table Widget 5-->
					<div class="card card-flush h-xl-100">
						<!--begin::Card header-->
						<div class="card-header pt-7">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Stock Report</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Total 2,356 Items in the Stock</span>
							</h3>
							<!--end::Title-->
							<!--begin::Actions-->
							<div class="card-toolbar">
								<!--begin::Filters-->
								<div class="d-flex flex-stack flex-wrap gap-4">
									<!--begin::Destination-->
									<div class="d-flex align-items-center fw-bolder">
										<!--begin::Label-->
										<div class="text-muted fs-7 me-2">Cateogry</div>
										<!--end::Label-->
										<!--begin::Select-->
										<select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
											<option></option>
											<option value="Show All" selected="selected">Show All</option>
											<option value="a">Category A</option>
											<option value="b">Category B</option>
										</select>
										<!--end::Select-->
									</div>
									<!--end::Destination-->
									<!--begin::Status-->
									<div class="d-flex align-items-center fw-bolder">
										<!--begin::Label-->
										<div class="text-muted fs-7 me-2">Status</div>
										<!--end::Label-->
										<!--begin::Select-->
										<select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-5="filter_status">
											<option></option>
											<option value="Show All" selected="selected">Show All</option>
											<option value="In Stock">In Stock</option>
											<option value="Out of Stock">Out of Stock</option>
											<option value="Low Stock">Low Stock</option>
										</select>
										<!--end::Select-->
									</div>
									<!--end::Status-->
									<!--begin::Search-->
									<a href="../../demo1/dist/apps/ecommerce/catalog/products.html" class="btn btn-light btn-sm">View Stock</a>
									<!--end::Search-->
								</div>
								<!--begin::Filters-->
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body">
							<!--begin::Table-->
							<table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
								<!--begin::Table head-->
								<thead>
									<!--begin::Table row-->
									<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
										<th class="min-w-100px">Item</th>
										<th class="text-end pe-3 min-w-100px">Product ID</th>
										<th class="text-end pe-3 min-w-150px">Date Added</th>
										<th class="text-end pe-3 min-w-100px">Price</th>
										<th class="text-end pe-3 min-w-50px">Status</th>
										<th class="text-end pe-0 min-w-25px">Qty</th>
									</tr>
									<!--end::Table row-->
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody class="fw-bolder text-gray-600">
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Macbook Air M1</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#XGY-356</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">02 Apr, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$1,230</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="58">
											<span class="text-dark fw-bolder">58 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Surface Laptop 4</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#YHD-047</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">01 Apr, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$1,060</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="0">
											<span class="text-dark fw-bolder">0 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Logitech MX 250</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#SRR-678</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">24 Mar, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$64</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="290">
											<span class="text-dark fw-bolder">290 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">AudioEngine HD3</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#PXF-578</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">24 Mar, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$1,060</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="46">
											<span class="text-dark fw-bolder">46 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">HP Hyper LTR</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#PXF-778</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">16 Jan, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$4500</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="78">
											<span class="text-dark fw-bolder">78 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Dell 32 UltraSharp</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#XGY-356</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">22 Dec, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$1,060</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-warning">Low Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="8">
											<span class="text-dark fw-bolder">8 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
									<tr>
										<!--begin::Item-->
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Google Pixel 6 Pro</a>
										</td>
										<!--end::Item-->
										<!--begin::Product ID-->
										<td class="text-end">#XVR-425</td>
										<!--end::Product ID-->
										<!--begin::Date added-->
										<td class="text-end">27 Dec, 2022</td>
										<!--end::Date added-->
										<!--begin::Price-->
										<td class="text-end">$1,060</td>
										<!--end::Price-->
										<!--begin::Status-->
										<td class="text-end">
											<span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
										</td>
										<!--end::Status-->
										<!--begin::Qty-->
										<td class="text-end" data-order="124">
											<span class="text-dark fw-bolder">124 PCS</span>
										</td>
										<!--end::Qty-->
									</tr>
								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Table Widget 5-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
@endsection