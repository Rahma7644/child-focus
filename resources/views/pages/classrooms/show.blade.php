@extends('layouts/layoutMaster')

@php
    $configData = Helper::appClasses();
    $teachers = $classroom->kindergarten->teachers;
@endphp

@section('title', 'الفصل الدراسي')

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
        'resources/assets/vendor/libs/pickr/pickr-themes.scss',
    ])
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-academy-details.scss')
@endsection

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

@section('page-script')
    @vite('resources/assets/js/app-academy-course-details.js')
@endsection

@section('content')

    <div class="row g-6">
        <div class="col-12">
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
                <div class="card-body">
                    <!-- Horizontal layout -->
                    <div class="d-flex gap-4">
                        <!-- Description box -->
                        <div class="card academy-content shadow-none border flex-fill">
                            <div class="card-body pt-4">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                                    <div class="me-1">
                                        <h5 class="mb-0">{{ $classroom->name }}</h5>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-danger">{{ $classroom->level }}</span>
                                        <i class='ti ti-share ti-lg mx-4'></i>
                                        <i class='ti ti-bookmarks ti-lg'></i>
                                    </div>
                                </div>
                                <hr class="my-3">
                                <h5>الوصف</h5>
                                <p class="mb-0">{{ $classroom->description }}</p>
                                <hr class="my-6">
                                <h5>حول</h5>
                                <div class="d-flex flex-wrap row-gap-2">
                                    <div class="me-12">
                                        <p class="text-nowrap mb-2">
                                            <i class='ti ti-users me-2 align-bottom'></i>
                                            السعة: {{ $classroom->capacity }} طالب
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-nowrap mb-2">
                                            <i class='ti ti-tag me-2 align-top ms-50'></i>
                                            المستوى الدراسي: {{ $classroom->level }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image box -->
                        @if($classroom->image)
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $classroom->image) }}"
                                    alt="صورة الفصل"
                                    class="rounded-2 shadow-sm"
                                    style="width: 100%; height: 300px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- teachers -->
        <div class="col-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">معلمو الفصل</h5>
                    </div>
                    <div>
                        <button type="button" class="add-new btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                            <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                            <span class="d-none d-sm-inline-block">اضافة</span>
                        </button>
                    </div>
                </div>
                <div class="px-5 py-4 border border-start-0 border-end-0">
                    <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-uppercase">المعلم</p>
                    <p class="mb-0 text-uppercase">الاجراءات</p>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ( $classroom->teachers as $teacher)
                        <div class="d-flex justify-content-between align-items-center mb-6">
                        <div class="d-flex align-items-center">
                            @php
                                $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                                $randomColor = $colors[array_rand($colors)];

                                $first = optional($teacher->user)->first_name;
                                $last = optional($teacher->user)->last_name;
                                $initials = strtoupper(substr($first, 0, 1) . substr($last, 0, 1));
                            @endphp
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-3">
                                    <span class="avatar-initial rounded-circle bg-label-{{ $randomColor }}">{{ $initials }}</span>
                                </div>
                            </div>
                            <div>
                            <div>
                                <h6 class="mb-0 text-truncate">{{ $teacher->user->first_name }} {{ $teacher->user->last_name }}</h6>
                                <small class="text-truncate text-body">{{ $teacher->specialization }}</small>
                            </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end m-0">
                                    <a class="dropdown-item remove-teacher"
                                        href="javascript:void(0);"
                                        data-classroom-id="{{ $classroom->id }}"
                                        data-teacher-id="{{ $teacher->id }}">
                                        <i class="ti ti-trash me-2"></i>ازالة
                                    </a>
                                </div>
                            </div>
                        </div>
                        </div>
                        @empty
                        <div class="d-flex justify-content-center">
                            <p class="mb-0 text-muted">لا توجد بيانات متاحة</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!--/ teachrers -->
    </div>
    @include('_partials.classroomsTeacher');

@endsection
