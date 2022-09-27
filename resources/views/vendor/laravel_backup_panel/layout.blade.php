@include('layouts.header')
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        @include('layouts.sidebar')
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('layouts.topbar')
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="toolbar" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Backup Panel</h1>
                            <span class="h-20px border-gray-300 border-start mx-4"></span>
                        </div>
                    </div>
                </div>
                <livewire:laravel_backup_panel::app />
            </div>
            @include('layouts.copyright')
        </div>
    </div>
</div>
@include('layouts.footer')