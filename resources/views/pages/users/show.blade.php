@extends('layouts/layoutMaster')

@section('title', 'عرض المستخدم')
@php
    $role = $user->roles->first()->display_name;
    $configData = Helper::appClasses();
    $kindergartens = App\Models\Kindergarten::all();
    $classrooms = App\Models\Classroom::all();
@endphp

@section('vendor-style')
    @vite([
        'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
        'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
        'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
        'resources/assets/vendor/libs/animate-css/animate.scss',
        'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
        'resources/assets/vendor/libs/select2/select2.scss',
        'resources/assets/vendor/libs/@form-validation/form-validation.scss'
    ])
@endsection

@section('page-style')
    @vite([
        'resources/assets/vendor/scss/pages/page-user-view.scss'
    ])
@endsection

@section('vendor-script')
    @vite([
        'resources/assets/vendor/libs/moment/moment.js',
        'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
        'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
        'resources/assets/vendor/libs/cleavejs/cleave.js',
        'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
        'resources/assets/vendor/libs/select2/select2.js',
        'resources/assets/vendor/libs/@form-validation/popular.js',
        'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
        'resources/assets/vendor/libs/@form-validation/auto-focus.js'
    ])
@endsection

@section('page-script')
    @vite([
        'resources/assets/js/users.js',
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
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
        <!-- User Sidebar -->
        <div class="col-4 order-0">
            <!-- User Card -->
            <div class="card">
            <div class="card-body pt-12">

                <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                    <img class="img-fluid rounded mb-4" src="{{ asset('assets/img/user.png') }}" height="120" width="120" alt="User" />
                    <div class="user-info text-center">
                    <h5>{{ $user->first_name }} {{ $user->second_name }} {{ $user->last_name }}</h5>
                    <span class= "{{ $role == 'Manager' ? 'badge bg-label-primary' : ($role == 'Teacher' ? 'badge bg-label-info' : ($role == 'Child' ? 'badge bg-label-warning' : 'badge bg-label-secondary')) }}">
                        {{ $role == 'Manager' ? 'مسؤول روضة': ($role == 'Teacher' ? 'معلم' : ($role == 'Child' ? 'طفل' : 'مستخدم')) }}</span>
                    </div>
                </div>
                </div>
                <hr class="my-4"/>
                <div class="info-container d-flex justify-content-between">
                <ul class="list-unstyled mb-6">
                    <li class="mb-2">
                    <span class="h6"><i class="ti ti-mail ti-md"></i></span>
                    <span class="mx-3">{{ $user->email }}</span>
                    </li>
                    <li class="mb-2">
                    <span class="h6"><i class="ti ti-phone ti-md"></i></span>
                    <span class="mx-3">0{{ $user->phone }}</span>
                    </li>
                    <li class="mb-2">
                    <span class="h6"><i class="ti ti-calendar ti-md"></i></span>
                    <span class="mx-3">{{ $user->birth_date }}</span>
                    </li>
                    <li class="mb-2">
                    <span class="h6"><i class="ti ti-gender-bigender ti-md"></i></span>
                    <span class="mx-3">{{ $user->gender ? 'أنثى' : 'ذكر' }}</span>
                    </li>
                    <li class="mb-2">
                    <span class="h6"><i class="ti {{ $user->is_active ? 'ti-circle-check' : 'xbox-x' }} ti-md"></i></span>
                    <span class="mx-3">{{ $user->is_active ? 'مفعل' : 'غير مفعل' }}</span>
                    </li>
                </ul>
                <ul class="list-unstyled mb-6">
                    @switch($role)
                        @case('Teacher')
                            <li class="mb-2">
                                <span class="h6"><i class="ti ti-building ti-md"></i></span>
                                <span class="mx-3">{{ $user->teacher->kindergarten->name }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6"><i class="ti ti-book ti-md"></i></span>
                                <span class="mx-3">{{ $user->teacher->specialization }}</span>
                            </li>
                            @break

                        @case('Child')
                            <li class="mb-2">
                                <span class="h6"><i class="ti ti-id ti-md"></i></span>
                                <span class="mx-3">{{ $user->child->id }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6"><i class="ti ti-book ti-md"></i></span>
                                <span class="mx-3">{{ $user->child->classroom->name }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6"><i class="ti ti-flag ti-md"></i></span>
                                <span class="mx-3">{{ $user->child->nationality }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6"><i class="ti ti-map-pin ti-md"></i></span>
                                <span class="mx-3">{{ $user->child->address }}</span>
                            </li>
                            @break
                    @endswitch
                </ul>
                </div>
                @php
                    $userData = [
                        'user' => $user->toArray(),
                        'role' => $user->roles->first()->display_name,
                        'teacher' => $user->teacher,
                        'child' => $user->child,
                        'parents' => $user->child->parentts ?? [],
                    ]
                @endphp
                <div class="d-flex justify-content-center">
                    <a href="javascript:;" class="btn btn-primary me-4 edit-record"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasAddUser"
                        data-user='@json($userData)'
                        >تعديل</a>
                </div>
            </div>
            </div>
            <!-- /User Card -->
        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-8 order-1">
            <!-- User Pills -->
            <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-7 row-gap-2">
                <li class="nav-item"><a class="nav-link active" href="{{ route('users.show', $user->id) }}"><i class="ti ti-user-check ti-sm me-1_5"></i>حول</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.security', $user->id) }}"><i class="ti ti-lock ti-sm me-1_5"></i>امان الحساب</a></li>
            </ul>
            </div>
            <!--/ User Pills -->

            <!-- about  -->
            @if ($role === 'Teacher')
            @php
                $classrooms = $user->teacher->classrooms;
            @endphp
            <div class="card">
                <h5 class="card-header">الفصول الدراسية</h5>
                <div class="card-body pt-1">
                    <div class="row gx-3 my-3" id="classroomContainer">
                        @forelse ( $classrooms as $classroom )
                            <div class="col-sm-6 col-lg-4 d-flex classroom-card" style="height: 45vh;" data-level="{{ $classroom->level }}">
                                <div class="card p-2 w-100 h-100 shadow-none border">
                                    <div class="rounded-2 text-center mb-4 position-relative">
                                        <span class="badge bg-label-info position-absolute top-0 end-0 m-1 px-3">{{ $classroom->level }}</span>
                                        <a href="{{ route('classrooms.show', $classroom->id) }}">
                                            <img class="img-fluid object-contain rounded"
                                                src="{{ asset('storage/' . $classroom->image) }}"
                                                alt="صورة الفصل"
                                                style="width: 100%; height: 140px; object-fit: cover;" />
                                        </a>
                                    </div>
                                    <div class="card-body p-2 pt-2">
                                        <a href="{{ route('classrooms.show', $classroom->id) }}" class="h6">{{$classroom->name}}</a>
                                        <p class="d-flex align-items-center mb-2 mt-4">
                                            <i class="ti ti-users ti-sm me-1"></i>
                                            <span class="fs-6">{{$classroom->capacity}}/0 طالب</span>
                                        </p>
                                        <div class="progress rounded-pill mb-4" style="height: 8px">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap">
                                            <a class="w-100 btn btn-label-primary d-flex align-items-center" href="{{ route('classrooms.show', $classroom->id) }}">
                                            <span class="fs-6 me-2">التفاصيل</span><i class="ti ti-chevron-right ti-xs scaleX-n1-rtl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="d-flex justify-content-center align-items-center" style="height: 45vh;">
                                <p class="text-muted fs-5">لا توجد بيانات متاحة </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @elseif ($role === 'Child')
            <div class="d-flex gap-12">
                <div class="card col-6" style="height: 62.5vh;">
                    <h5 class="card-header">اولياء الامر</h5>
                    @php
                        $parents = $user->child->parentts;
                    @endphp
                    <div class="card-body pt-1">
                        <ul class="timeline mb-0">
                            @foreach ( $parents as $parent )
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">{{ $parent->relationship }}</h6>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap gap-3 mb-2">
                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                    <div class="avatar avatar-md me-2">
                                        <img src="{{ asset('assets/img/user.png') }}" alt="Avatar" class="rounded-circle" />
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-0 small fw-medium"><i class="ti ti-user ti-xs me-2"></i>{{ $parent->name }}</p>
                                        <small><i class="ti ti-phone ti-xs me-2"></i>{{ $parent->phone }}</small><br/>
                                        <small><i class="ti ti-map-pin ti-xs me-2"></i>{{ $parent->work_address }}</small>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card col-5 ms-4">
                    <h5 class="card-header">الفصل الدراسي</h5>
                    <div class="card-body pt-1">
                        <div class="row" id="classroomContainer">
                            @php
                                $classroom = $user->child->classroom;
                            @endphp
                            <div class="col-12 d-flex classroom-card" style="height: 45vh;" data-level="{{ $classroom->level }}">
                                <div class="card p-2 w-100 h-100 shadow-none border">
                                    <div class="rounded-2 text-center mb-4 position-relative">
                                        <span class="badge bg-label-info position-absolute top-0 end-0 m-1 px-3">{{ $classroom->level }}</span>
                                        <a href="{{ route('classrooms.show', $classroom->id) }}">
                                            <img class="img-fluid object-contain rounded"
                                                src="{{ asset('storage/' . $classroom->image) }}"
                                                alt="صورة الفصل"
                                                style="width: 100%; height: 140px; object-fit: cover;" />
                                        </a>
                                    </div>
                                    <div class="card-body p-2 pt-2">
                                        <a href="{{ route('classrooms.show', $classroom->id) }}" class="h6">{{$classroom->name}}</a>
                                        <p class="d-flex align-items-center mb-2 mt-4">
                                            <i class="ti ti-users ti-sm me-1"></i>
                                            <span class="fs-6">{{$classroom->capacity}}/0 طالب</span>
                                        </p>
                                        <div class="progress rounded-pill mb-4" style="height: 8px">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap">
                                            <a class="w-100 btn btn-label-primary d-flex align-items-center" href="{{ route('classrooms.show', $classroom->id) }}">
                                                <span class="fs-6 me-2">التفاصيل</span><i class="ti ti-chevron-right ti-xs scaleX-n1-rtl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- /about -->

        </div>
        <!--/ User Content -->
    </div>

    @include('_partials/users')

@endsection
