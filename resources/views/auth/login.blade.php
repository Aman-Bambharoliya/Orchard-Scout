@extends('layouts.auth')
@section('content')
<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="text-center mb-10">
        <h1 class="text-dark mb-3">Log In</h1>
    </div>
    <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
        <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="text"
            name="email" value="{{ old('email') }}" required autocomplete="email" />
        @error('email')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
        </div>
        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
            type="password" name="password" required autocomplete="current-password" />
        @error('password')
        <span class="invalid-feedback" role="alert">
           {{ $message }}
        </span>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
            <span class="indicator-label">Login</span>
        </button>
    </div>
</form>
@endsection