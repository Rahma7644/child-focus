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
    @vite(['resources/assets/js/archive.js'])
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
                أرشيف المستخدمين</h5>
        </div>
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">الفلترة</h5>
            <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
                <div class="col-md-4 user_role"></div>
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
                        <th>الدور</th>
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
                            <td>
                                @foreach ($user->roles as $role)
                                    @php
                                        switch ($role->name) {
                                            case 'manager':
                                                $label = ' مدير روضة';
                                                $class = 'bg-label-primary';
                                                break;
                                            case 'teacher':
                                                $label = 'معلم';
                                                $class = 'bg-label-info';
                                                break;
                                            case 'parent':
                                                $label = 'ولي أمر';
                                                $class = 'bg-label-success';
                                                break;
                                            default:
                                                $label = $role->name;
                                                $class = 'bg-label-secondary';
                                        }
                                    @endphp

                                    <span class="badge {{ $class }} me-1">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </td>

                            <td>{{ $user->birth_date }}</td>
                            <td>{{ $user->gender == '0' ? 'ذكر' : 'انثى' }}</td>
                            <td>
                                <span
                                    class="{{ $user->is_active == '1' ? 'badge bg-label-success' : 'badge bg-label-danger' }}">
                                    {{ $user->is_active == '1' ? 'مفعل' : 'غير مفعل' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:;"
                                        class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill restore-user" data-id="{{ $user->id }}">
                                        <i class="ti ti-archive-off ti-md"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
