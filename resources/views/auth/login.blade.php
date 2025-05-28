@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'تسجيل الدخول')

@section('vendor-style')
    @vite([
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
    @vite([
    'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
    @vite([
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/cleavejs/cleave.js',
    'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
])
@endsection

@section('page-script')
    @vite([
    'resources/assets/js/login.js',
])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{url('/')}}" class="app-brand-link">
                                <span
                                    class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' => "fill: #fff;"])</span>
                                <span
                                    class="app-brand-text demo text-heading fw-bold">Child Focus</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 fw-bold">تسجيل الدخول</h4>
                        <P></P>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 mx-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-4" action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="phone">رقم الهاتف</label>
                                <div class="input-group">
                                    <input type="text" id="phone" name="phone" class="form-control phone-number-mask" placeholder="92XXXXXXX" maxlength="9"
                                    pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)" autofocus/>
                                    <span class="input-group-text">LY (+218)</span>
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <div class="my-8">
                                <div class="d-flex justify-content-between">
                                    <a href="{{url('auth/forgot-password-basic')}}">
                                        <p class="mb-0">هل نسيت كلمة المرور؟</p>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">تسجيل الدخول</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>ليس لديك حساب؟</span>
                            <a href="{{url('auth/register-basic')}}">
                                <span>انشاء حساب</span>
                            </a>
                        </p>

                        <div class="divider my-6">
                            <div class="divider-text">أو</div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
                                <i class="tf-icons ti ti-brand-facebook-filled"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
                                <i class="tf-icons ti ti-brand-twitter-filled"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
                                <i class="tf-icons ti ti-brand-github-filled"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
                                <i class="tf-icons ti ti-brand-google-filled"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection
