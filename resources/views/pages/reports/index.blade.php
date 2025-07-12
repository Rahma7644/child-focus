@extends('layouts/layoutMaster')

@section('title', 'البلاغات')

@section('vendor-style')
    @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss'
])
@endsection

@section('vendor-script')
    @vite([
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'
])
@endsection

@section('page-script')
    @vite('resources/assets/js/report.js')
@endsection

@php
        use App\Models\Report;

        $reportingUsers = Report::distinct('user_id')->count('user_id');
        $totalReports = Report::count();
        $openReports = Report::where('status', 'open')->count();
        $closedReports = Report::where('status', 'closed')->count();

@endphp


@section('content')
    <!-- Invoice List Widget -->

    <div class="card mb-6">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                            <div>
                                <h4 class="mb-0">{{$reportingUsers}}</h4>
                                <p class="mb-0">مستخدم</p>
                            </div>
                            <div class="avatar me-sm-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="ti ti-user ti-26px"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6">
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                            <div>
                                <h4 class="mb-0">{{$totalReports}}</h4>
                                <p class="mb-0">اجمالي البلاغات</p>
                            </div>
                            <div class="avatar me-lg-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="ti ti-file-invoice ti-26px"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
                            <div>
                                <h4 class="mb-0">{{$openReports}}</h4>
                                <p class="mb-0">بلاغ مفتوح</p>
                            </div>
                            <div class="avatar me-sm-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="ti ti-checks ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">{{$closedReports}}</h4>
                                <p class="mb-0">بلاغ مغلق</p>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="ti ti-circle-off ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice List Table -->
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
        <div class="card-datatable table-responsive">
            <table class="invoice-list-table table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>المستخدم</th>
                        <th>نوع البلاغ</th>
                        <th>الحالة</th>
                        <th class="text-truncate">التاريخ</th>
                        <th class="cell-fit">الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <a href="#">#{{ $report->id }}</a>
                                                </td>

                                                <td>
                                                    @php
    $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
    $randomColor = $colors[array_rand($colors)];

    $first = optional($report->user)->first_name;
    $last = optional($report->user)->last_name;
    $initials = strtoupper(substr($first, 0, 1) . substr($last, 0, 1));
                                                    @endphp

                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar avatar-sm me-3">
                                                                <span class="avatar-initial rounded-circle bg-label-{{ $randomColor }}">{{ $initials }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-medium">{{ $report->user->first_name }} {{ $report->user->last_name }}</span>
                                                            <small class="text-truncate">{{ $report->user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $report->type }}</td>
                                                <td>
                                                    @php
    $status = $report->status;
    $statusMap = [
        'open' => ['label' => 'مفتوح', 'class' => 'bg-label-warning'],
        'active' => ['label' => 'قيد المعالجة', 'class' => 'bg-label-info'],
        'closed' => ['label' => 'مغلق', 'class' => 'bg-label-success'],
    ];
                                                    @endphp
                                                    <span class="badge {{ $statusMap[$status]['class'] ?? 'bg-label-secondary' }}">{{ $statusMap[$status]['label'] ?? 'غير معروف' }}</span>
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($report->created_at)->format('Y/m/d') }}</td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                            <i class="ti ti-edit ti-md"></i>
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
