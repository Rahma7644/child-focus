@extends('layouts/layoutMaster')
@php
    $configData = Helper::appClasses();
@endphp

@section('title', 'الفصول الدراسية')

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
@vite('resources/assets/vendor/scss/pages/app-academy.scss')
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
@vite('resources/assets/js/classroom.js')
@endsection

@section('content')
<div class="app-academy">

    <div class="card mb-6">
        <div class="card-header d-flex flex-wrap justify-content-between gap-4">
    <div class="card-title mb-0 me-1">
        <h5 class="mb-0">الفصول الدراسية</h5>
    </div>

    <div class="d-flex align-items-center gap-2 flex-nowrap">
        <!-- Filter Dropdown -->
        <div class="col-6">
        <select id="levelFilter" class="selectpicker w-auto" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white" >
            <option value="">المستوى الدراسي</option>
            <option value="kg1">kg1</option>
            <option value="kg2">kg2</option>
        </select>
        </div>

        <div class="dt-buttons btn-group flex-wrap">
            <button
                class="btn btn-secondary add-new btn-primary waves-effect waves-light mx-2"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#classModal"
                style="white-space: nowrap;">
                <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">إضافة فصل</span>
                </span>
            </button>
        </div>
    </div>
</div>

        <div class="card-body">
            <div class="row gy-6 mb-6" id="classroomContainer">
                @foreach ( $classrooms as $classroom )
                    <div class="col-sm-6 col-lg-4 classroom-card" data-level="{{ $classroom->level }}">
                        <div class="card p-2 h-100 shadow-none border">
                            <div class="rounded-2 text-center mb-4">
                            <a href="{{url('app/academy/course-details')}}"><img class="img-fluid" src="{{asset('assets/img/pages/app-academy-tutor-1.png')}}" /></a>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <a href="{{url('app/academy/course-details')}}" class="h5">{{$classroom->name}}</a>
                                <p>{{$classroom->description}}</p>
                                {{-- <span class="badge bg-label-primary">{{$classroom->level}}</span> --}}
                                <p class="d-flex align-items-center my-2"><i class="ti ti-users me-1"></i></p>
                                <div class="progress rounded-pill mb-4" style="height: 8px">
                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap flex-md-nowrap  flex-lg-wrap flex-xxl-nowrap">
                                    <a class="w-100 btn btn-label-primary d-flex align-items-center" href="{{url('app/academy/course-details')}}">
                                    <span class="me-2">التفاصيل</span><i class="ti ti-chevron-right ti-xs scaleX-n1-rtl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination  pagination-rounded justify-content-center" id="paginationContainer">
                </ul>
            </nav>

        </div>
    </div>
</div>

@include('_partials.classrooms');
@endsection
