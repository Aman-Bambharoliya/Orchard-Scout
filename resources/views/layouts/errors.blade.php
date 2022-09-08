<div class="row g-7 notification-wrapper">
    <div class="col-xl-12 error-wrap-clm">
        <div class="error-msg-box">
            @if ($message = Session::get('success'))
            <div
                class="alert alert-success">
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    {{ $message }}
                </div>
            </div>
            @elseif ($message = Session::get('error'))
            <div
                class="alert alert-danger">
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    {{ $message }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<style>
    .row.g-7.notification-wrapper .error-wrap-clm .alert {
    margin-top: 10px;
    margin-bottom: -10px;
    margin-right: 13px;
    margin-left: 13px;
    }
    .error-msg-box .alert {
    margin-bottom: -18px;
    }
</style>

