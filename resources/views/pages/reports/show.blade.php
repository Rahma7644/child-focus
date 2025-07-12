@extends('layouts/layoutMaster')

@section('title', 'البلاغات')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/flatpickr/flatpickr.scss')
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-invoice.scss')
@endsection

@section('vendor-script')
    @vite([
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/cleavejs/cleave.js',
    'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
    'resources/assets/vendor/libs/jquery-repeater/jquery-repeater.js'
])
@endsection


@section('content')
    <div class="row invoice-edit">
        <!-- report view-->
        <div class="col-lg-9 col-12 mb-lg-0 mb-6">

            <div class="card invoice-preview-card p-sm-12 p-6">
                <div >
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>                        @foreach ($errors->all() as $error)
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
                <div class="card-body invoice-preview-header rounded">
                    <div class="row text-heading px-3">
                        <div class="col-md-5 col-8 pe-0 ps-0 ps-md-2">
                            <dl class="row mb-0 gx-4">
                                <dt class="col-sm-3 mb-2 d-md-flex align-items-center justify-content-end">
                                    <span class="text-capitalize mb-0 text-nowrap">بلاغ</span>
                                </dt>
                                <dd class="col-sm-7">
                                    <div class="input-group input-group-merge disabled">
                                        <span class="input-group-text">#</span>
                                        <input type="text" class="form-control" disabled  value="{{ $report->id }}" />
                                    </div>
                                </dd>
                                <dt class="col-sm-3 mb-2 d-md-flex align-items-center justify-content-end">
                                    <span class="fw-normal">التاريخ</span>
                                </dt>
                                <dd class="col-sm-7">
                                    <input type="text" class="form-control invoice-date" disabled value="{{ $report->created_at }}" />
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-2 d-none d-md-block">
                            <!-- Spacer to create a gap on medium+ screens -->
                        </div>
                        <div class="col-md-5 col-8 pe-0 ps-0 ps-md-2">
                            <dl class="row mb-0 gx-4">
                                <dt class="col-sm-4 mb-2 d-md-flex align-items-center justify-content-end">
                                    <span class="text-capitalize mb-0 text-nowrap">اسم المستخدم</span>
                                </dt>
                                <dd class="col-sm-7">
                                    <div class="input-group input-group-merge disabled">
                                        <input type="text" class="form-control" disabled value="{{ $report->user->first_name }} {{ $report->user->last_name }}" />
                                    </div>
                                </dd>
                                <p></p>
                                <dt class="col-sm-4 mb-2 d-md-flex align-items-center justify-content-end">
                                    <span class="fw-normal">بريد المستخدم</span>
                                </dt>
                                <dd class="col-sm-7">
                                    <input type="text" class="form-control invoice-date" disabled value="{{ $report->user->email }}" />
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                    <hr class="my-0">
                    <div class="card-body px-0">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="invoice-date" class="fw-medium text-heading mb-3">نوع البلاغ</label>
                                <input type="text" class="form-control" value="{{ $report->type }}" />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="invoice-date" class="fw-medium text-heading mb-3">العنوان</label>
                                <input type="text" class="form-control" value="{{ $report->title }}" />
                            </div>
                            <div class="col-12">
                                <label for="note" class="fw-medium text-heading mb-3">الوصف</label>
                                <textarea class="form-control" rows="4">{{ $report->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /report view-->

        <!-- report Actions -->
        <div class="col-lg-3 col-12 invoice-actions">
            <div class="card mb-6 p-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('reports.update', $report->id) }}" >
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status" class="form-label fw-medium mb-3">حالة البلاغ</label>
                            <select name="status" id="status" class="form-select">
                                <option value="open" {{ $report->status == 'open' ? 'selected' : '' }}>مفتوح</option>
                                <option value="active" {{ $report->status == 'acive' ? 'selected' : '' }}>قيد المعالجة</option>
                                <option value="closed" {{ $report->status == 'closed' ? 'selected' : '' }}>مغلق</option>
                            </select>
                        </div>
                        <div class="my-4 d-flex justify-content-center">
                            <button type="submit" class="col-12 btn btn-primary">تحديث الحالة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /report Actions -->
    </div>
@endsection
