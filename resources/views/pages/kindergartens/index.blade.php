@extends('layouts/layoutMaster')

@section('title', 'إدارة الروضات')


<!-- Vendor Styles -->
@section('vendor-style')
    @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/animate-css/animate.scss',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
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
    @vite(['resources/assets/js/kindergarten.js'])
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
            <h5 class="card-title mb-0">الروضات</h5>
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
                        <th>اسم الروضة</th>
                        <th>رقم الهاتف</th>
                        <th>العنوان</th>
                        <th>مدير الروضة</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($KGs as $kg)
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td>{{ $kg->id }}</td>
                                                                                            @php
                        $color = 'primary';

                        $kgName = $kg->name ?? '';
                        $logo = $kg->logo ?? null;

                        $initials = '';
                        if (!$logo && $kgName) {
                            $words = explode(' ', $kgName);
                            if (count($words) == 1) {
                                $initials = strtoupper(substr($words[0], 0, 1));
                            } else {
                                $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                            }
                        }
                                                                                            @endphp
                                                                                            <td>
                                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                                    <div class="avatar-wrapper">
                                                                                                        <div class="avatar avatar-sm me-3">
                                                                                                            @if ($logo)
                                                                                                                <img src="{{ asset('storage/' . $logo) }}" alt="{{ $kgName }} Logo" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                                                                            @else
                                                                                                                <span class="avatar-initial rounded-circle bg-label-{{ $color }}" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                                                                                    {{ $initials }}
                                                                                                                </span>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                        <span class="fw-medium">{{ $kgName }}</span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>0{{ $kg->phone }}</td>
                                                                                            <td>
                                                                                                <a href="{{$kg->address}}"> {{$kg->address }}</a>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="d-flex flex-column">
                                                                                                    <small class="fw-medium">{{ $kg->manager->user->first_name }} {{ $kg->manager->user->last_name }}</small>
                                                                                                    <a href="mailto:{{ $kg->manager->user->email }}" class=" text-truncate">{{ $kg->manager->user->email }}</a>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <span class="{{ $kg->manager->user->is_active == '1' ? 'badge bg-label-success' : 'badge bg-label-danger' }}">
                                                                                                    {{ $kg->manager->user->is_active == '1' ? 'مفعل' : 'غير مفعل' }}
                                                                                                </span>
                                                                                            </td>

                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <a href="javascript:;"
                                                                                                        class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill edit-record"
                                                                                                        data-bs-toggle="modal" data-bs-target="#kgModal" data-user='@json($kg)'>
                                                                                                        <i class="ti ti-edit ti-md"></i>
                                                                                                    </a>
                                                                                                    <a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                        <i class="ti ti-dots-vertical ti-md"></i>
                                                                                                    </a>
                                                                                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                                                                                        <a href="javascript:;"
                                                                                                            class="dropdown-item toggle-status"
                                                                                                            data-id="{{ $kg->manager->user->id }}"
                                                                                                            data-status="{{ $kg->manager->user->id ? 'active' : 'inactive' }}">
                                                                                                            {{ $kg->manager->user->id ? 'تعطيل' : 'تفعيل' }}
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

    @include('_partials.kindergardens')

@endsection
