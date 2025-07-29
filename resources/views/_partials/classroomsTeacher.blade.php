<!-- Modal -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <form id="ctForm" action="{{ route('classrooms.teacher.attach', $classroom->id )}}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">إضافة معلم للفصل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <!-- teacher Section -->
                <div class="row mb-6 mt-0 g-3">
                    <div class="col-sm-12">
                        <div class="d-flex align-items-center gap-2">
                            <div id="userSelectWrapper" class="flex-grow-1">
                                <label id="teacherLabel" class="form-label" for="teacher_id">المعلم</label>
                                <select id="teacher_id" name="teacher_id" class="select2 form-select">
                                        <option value="" disabled selected>اختر</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->user->first_name }} {{ $teacher->user->last_name }} - {{ $teacher->user->email }} -- {{ $teacher->specialization }}
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

                    <!-- Add New teacher Fields -->
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
                        <div class="col-sm-4">
                            <label class="form-label" for="email">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com" />
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label" for="phone">رقم الهاتف</label>
                            <div class="input-group">
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="92XXXXXXX" maxlength="9"
                                    pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)" />
                                    <span class="input-group-text">LY (+218)</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label" for="specialization">التخصص</label>
                            <input type="text" id="specialization" name="specialization" class="form-control" placeholder="لغة عربية" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="gender">الجنس</label>
                            <select id="gender" name="gender" class="selectpicker w-auto" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white">
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

                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-label-danger me-2" data-bs-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-primary">اضافة</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
