@extends('layouts.app')
@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{__('Customer Phones')}}</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('Home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('customers.index')}}" class="text-muted text-hover-primary">{{__('Customers')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">{{__('Customer Phones')}}</li>
</ul>
@endsection
@section('main-content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        @include('layouts.errors')
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
                            class="form-control form-control-solid w-250px ps-15" placeholder="{{__('Search Customer Phone')}}" />
                    </div>
                </div>
                <div class="card-toolbar">
                    @permission('customer-phones','create')
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <a href="{{route('customer-phones.create',$customer_id)}}" class="btn btn-primary">Add</a>
                    </div>
                    @endpermission
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTableList">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-15px">{{__('No.')}}</th>
                            <th class="min-w-15px">{{__('Phone Type')}}</th>
                            <th class="min-w-90px">{{__('Country Code')}}</th>
                            <th class="min-w-125px">{{__('Area Code')}}</th>
                            <th class="min-w-125px">{{__('Prefix')}}</th>
                            <th class="min-w-125px">{{__('Number')}}</th>
                            <th class="min-w-100px">{{__('Extension')}}</th>
                            <th class="min-w-70px">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script>
    var listIndex = "{{ route('customer-phones.index',$customer_id) }}"
</script>
<script src="{{asset('js/module/customer-phones.js')}}"></script>
@endsection