<!-- Edit User Modal -->
<div class="modal fade" id="kgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-kg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form id="kgForm" class="row g-6" action="{{ route('kindergartens.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Kindergarten Section -->
                    <h5 class="my-3">بيانات الروضة</h5>
                    <div class="row mb-3 mt-0 g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="kgName">اسم الروضة</label>
                            <input type="text" name="kgName" id="kgName" class="form-control" placeholder="اسم الروضة" autofocus />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="kgLocation">العنوان</label>
                            <input type="text" name="kgLocation" id="kgLocation" class="form-control" placeholder="عنوان الروضة" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="kgPhone">رقم الهاتف</label>
                            <div class="input-group">
                                <input type="text" id="kgPhone" name="kgPhone" class="form-control phone-number-mask" placeholder="92XXXXXXX"
                                    maxlength="9" pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)" />
                                <span class="input-group-text">LY (+218)</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="kgLogo">شعار الروضة</label>
                            <input type="file" name="kgLogo" id="kgLogo" class="form-control" accept="image/*" />
                            <small class="text-muted">قم برفع شعار الروضة إن وجد.</small>
                        </div>
                    </div>

                    <hr class="my-4" />
@php
$managers = App\Models\Manager::all();
                                        @endphp
                    <!-- Manager Section -->
                    <h5 class="my-3">مدير الروضة</h5>
                    <div class="row mb-3 mt-0 g-3">
                        <div class="col-sm-12">
                            <div class="d-flex align-items-center gap-2">
                                <div id="userSelectWrapper" class="flex-grow-1">
                                    <label id="managerLabel" class="form-label" for="manager_id">مدير الروضة</label>
                                    <select id="manager_id" name="manager_id" class="select2 form-select">
                                        <option value="" disabled selected>اختر</option>

                                        @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">
                                                {{ $manager->user->first_name }} {{ $manager->user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="button" class="btn btn-md bg-label-primary mt-6" id="toggleAddUserBtn">
                                    <i class="ti ti-user-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Manager Fields -->
                    <div id="newUserFields" class="mt-0" style="display:none;" >
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <label class="form-label" for="first_name">الاسم الاول</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="الاسم الاول" />
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
                                <label class="form-label" for="email">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com" />
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="phone">رقم الهاتف</label>
                                <div class="input-group">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="92XXXXXXX" maxlength="9"
                                        pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)" />
                                    <span class="input-group-text">LY (+218)</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="gender">الجنس</label>
                                <select id="gender" name="gender" class="select form-select" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white" >
                                    <option value="" disabled selected>اختر</option>
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
                                <input type="password" id="password" name="password" class="form-control" placeholder="********" />
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                    placeholder="********" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">حفظ</button>
                        <button type="reset" class="btn btn-label-secondary">الغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

