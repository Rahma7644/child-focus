@extends('layouts/layoutMaster')

@section('title', 'إدارة المستخدمين')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite([
        'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
        'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
        'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
        'resources/assets/vendor/libs/select2/select2.scss',
        'resources/assets/vendor/libs/@form-validation/form-validation.scss',
        'resources/assets/vendor/libs/animate-css/animate.scss',
        'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
        'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
        'resources/assets/vendor/libs/select2/select2.scss',
        'resources/assets/vendor/libs/@form-validation/form-validation.scss',
        'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
        'resources/assets/vendor/libs/pickr/pickr-themes.scss'

    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/cleavejs/cleave.js',
    'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/pickr/pickr.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/js/laravel-user-management.js'])
@endsection

@section('content')

    <!-- Users List Table -->
    <div class="card">
        <div class="m-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            </div>
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">
                    {{ $role == 'Manager' ? 'مسؤولي الروضة' : ($role == 'Teacher' ? 'المعلمين' : ($role == 'Parent' ? 'أولياء الأمر' : 'المستخدمين')) }}
                </h5>
        </div>
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">الفلترة</h5>
            <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table">
                <thead class="border-top">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>تاريخ الميلاد</th>
                        <th>الجنس</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td></td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>0{{ $user->phone }}</td>
                            <td>{{ $user->birth_date }}</td>
                            <td>{{ $user->gender == '0' ? 'ذكر' : 'انثى' }}</td>
                            <td>
                                <span class="{{ $user->is_active == '1' ? 'badge bg-label-success' : 'badge bg-label-danger' }}">
                                    {{ $user->is_active == '1' ? 'مفعل' : 'غير مفعل' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:;"
                                        class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill edit-record"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasAddUser"
                                        data-user='@json($user)'>
                                            <i class="ti ti-edit ti-md"></i>
                                    </a>
                                    <a href="javascript:;"
                                        class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical ti-md"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            @if(!$user->is_active)
                                                <a href="javascript:;" class="delete-record dropdown-item" data-id="{{ $user->id }}">أرشفة</a>
                                            @endif
                                            <a href="javascript:;"
                                                class="dropdown-item toggle-status"
                                                data-id="{{ $user->id }}"
                                                data-status="{{ $user->is_active ? 'active' : 'inactive' }}">
                                                {{ $user->is_active ? 'تعطيل' : 'تفعيل' }}
                                            </a>
                                        </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('_partials.users')

@endsection
