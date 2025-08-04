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
        'resources/assets/vendor/libs/select2/select2.scss',
        'resources/assets/vendor/libs/@form-validation/form-validation.scss',
        'resources/assets/vendor/libs/animate-css/animate.scss',
        'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
        'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
        'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
        'resources/assets/vendor/libs/pickr/pickr-themes.scss'
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
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/cleavejs/cleave.js',
    'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/pickr/pickr.js'
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
        <div class="col-xl-4 col-lg-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card">
            <div class="card-body pt-12">

                <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                    <img class="img-fluid rounded mb-4" src="{{ asset('assets/img/user.png') }}" height="120" width="120" alt="User" />
                    <div class="user-info text-center">
                    <h5>{{ $user->first_name }} {{ $user->second_name }} {{ $user->last_name }}</h5>
                    <span class= "{{ $role == 'Manager' ? 'badge bg-label-primary' : ($role == 'Teacher' ? 'badge bg-label-info' : ($role == 'Child' ? 'badge bg-label-warning' : ($role == 'Super-admin' ? 'badge bg-label-danger' : 'badge bg-label-secondary'))) }}">
                        {{ $role == 'Manager' ? 'مسؤول روضة': ($role == 'Teacher' ? 'معلم' : ($role == 'Child' ? 'طفل' : ($role == 'Super-admin' ? 'مسؤول النظام' : 'مستخدم'))) }}</span>
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
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- User Pills -->
            <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-7 row-gap-2">
                @if ($role == 'Teacher' || $role == 'Child')
                    <li class="nav-item"><a class="nav-link " href="{{ route('users.show', $user->id) }}"><i class="ti ti-user-check ti-sm me-1_5"></i>حول</a></li>
                @endif
                <li class="nav-item"><a class="nav-link active" href="{{ route('users.security', $user->id) }}"><i class="ti ti-lock ti-sm me-1_5"></i>امان الحساب</a></li>
            </ul>
            </div>
            <!--/ User Pills -->

            <!-- Change Password -->
            <div class="card mb-6">
                <h5 class="card-header">تغيير كلمة المرور</h5>
                <div class="card-body">
                    <form id="passForm" method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="mode" value="password">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <h5 class="alert-heading mb-1">تأكد من استيفاء هذه المتطلبات</h5>
                            <span>يجب أن تتكون من 8 أحرف على الأقل، وتحتوي على حرف كبير ورمز</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="row gx-6">
                            <div class="mb-4 col-sm-6 form-password-toggle">
                            <label class="form-label" for="password">كلمة المرور الجديدة</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            </div>

                            <div class="mb-4 col-sm-6 form-password-toggle">
                            <label class="form-label" for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-primary">تغيير كلمة المرور</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Change Password -->

        </div>
        <!--/ User Content -->
    </div>

    @include('_partials/users')

@endsection
