@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'التسجيل')

@section('vendor-style')
    @vite([
    'resources/assets/vendor/libs/bs-stepper/bs-stepper.scss',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/pickr/pickr-themes.scss'
])
@endsection

@section('page-style')
    @vite([
    'resources/assets/vendor/scss/pages/page-auth.scss',
])
@endsection

@section('vendor-script')
    @vite([
    'resources/assets/vendor/libs/bs-stepper/bs-stepper.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/pickr/pickr.js'
])
@endsection


@section('page-script')
    @vite([
    'resources/assets/js/register.js'
])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6" style="max-width: 800px">
                <div class="card">
                    <div id="register-validation" class="card-body bs-stepper p-0">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#kg-info-validation">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label mt-1">
                                            <span class="bs-stepper-title">بيانات الروضة</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#personal-info-validation">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">بيانات مدير الروضة</span>
                                        </span>
                                    </button>
                                </div>
                            </div>


                            <div class="bs-stepper-content">
                                <form id="register-form" action="{{route('register')}}" method="POST">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0 mx-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <!-- KG Info -->
                                    <div id="kg-info-validation" class="content">
                                        <div class="content-header mb-4">
                                            <small>ادخل بيانات الروضة :</small>
                                        </div>
                                        <div class="row g-6">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="kgName">اسم الروضة</label>
                                                <input type="text" name="kgName" id="kgName" class="form-control" placeholder="اسم الروضة" autofocus/>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="kgLocation">العنوان</label>
                                                <input type="text" name="kgLocation" id="kgLocation" class="form-control" placeholder="عنوان الروضة" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="kgPhone">رقم الهاتف</label>
                                                <div class="input-group">
                                                    <input type="text" id="kgPhone" name="kgPhone" class="form-control phone-number-mask" placeholder="92XXXXXXX" maxlength="9"
                                                    pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)"/>
                                                    <span class="input-group-text">LY (+218)</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="kgLogo">شعار الروضة </label>
                                                <input type="file" name="kgLogo" id="kgLogo" class="form-control" accept="image/*" />
                                                <small class="text-muted">قم برفع شعار الروضة إن وجد.</small>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-label-secondary btn-prev" disabled>
                                                    <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">السابق</span>
                                                </button>
                                                <button class="btn btn-primary btn-next" type="button">
                                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">التالي</span>
                                                    <i class="ti ti-arrow-right ti-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Personal Info -->
                                    <div id="personal-info-validation" class="content">
                                        <div class="content-header mb-4">
                                            <small>ادخل بيانات مدير الروضة :</small>
                                        </div>
                                        <div class="row g-6">
                                            <div class="col-sm-4">
                                                <label class="form-label" for="first_name">الاسم الاول</label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="الاسم الاول" autofocus />
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="second_name">الاسم الثاني</label>
                                                <input type="text" id="second_name" name="second_name" class="form-control" placeholder="الاسم الثاني" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="last_name">اللقب</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="اللقب" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="email">البريد الالكتروني</label>
                                                <input type="text" id="email" name="email" class="form-control" placeholder="email@example.com" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="phone">رقم الهاتف</label>
                                                <div class="input-group">
                                                    <input type="text" id="phone" name="phone" class="form-control phone-number-mask" placeholder="92XXXXXXX" maxlength="9"
                                                    pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)"/>
                                                    <span class="input-group-text">LY (+218)</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="gender">الجنس</label>
                                                <select class="selectpicker w-auto" id="gender" name="gender" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white">
                                                    <option value="" selected disabled>اختر</option>
                                                    <option value="0">ذكر</option>
                                                    <option value="1">أنثى</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="birth_date">تاريخ الميلاد</label>
                                                <div class="input-group">
                                                    <input type="text" id="birth_date" name="birth_date" class="form-control" placeholder="YYYY-MM-DD" />
                                                    <span class="input-group-text">
                                                        <i class="ti ti-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="password">كلمة المرور</label>
                                                <input type="password" id="password" name="password" class="form-control" placeholder="********"/>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="password_confirmation">تاكيد كلمة المرور</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********" />
                                            </div>

                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-label-secondary btn-prev">
                                                    <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">السابق</span>
                                                </button>
                                                <button class="btn btn-primary btn-next" type="submit">
                                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">ارسال</span>
                                                    <i class="ti ti-arrow-right ti-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


@endsection
