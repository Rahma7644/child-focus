<!-- Offcanvas to add new user -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">اضافة مستخدم</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="add-new-user pt-0" id="userForm" method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="row mb-6 g-6">
                <input type="hidden" name="role" value="{{$role}}" />
                <h6>بيانات {{ $role == 'Manager' ? ' مسؤولي الروضات': ($role == 'Teacher' ? 'المعلم' : ($role == 'Child' ? 'الطفل' :($role == 'Parent' ? 'ولي الأمر' : 'المستخدم'))) }}</h6>
                <div class="col-sm-4">
                    <label class="form-label" for="first_name">الاسم الاول</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="الاسم الاول" autofocus />
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="second_name">الاسم الثاني</label>
                    <input type="text" id="second_name" name="second_name" class="form-control" placeholder="الاسم الثاني" />
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="last_name">اللقب</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="اللقب" />
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="email">البريد الالكتروني</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="email@example.com" />
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="phone">رقم الهاتف</label>
                    <div class="input-group">
                        <input type="text" id="phone" name="phone" class="form-control phone-number-mask" placeholder="92XXXXXXX" maxlength="9"
                        pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)"/>
                        <span class="input-group-text">LY (+218)</span>
                    </div>
                </div>
                @if ($role == 'Teacher')
                    <div class="col-sm-12">
                        <label class="form-label" for="specialization">التخصص</label>
                        <input type="text" id="specialization" name="specialization" class="form-control" placeholder="لغة عربية" />
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="kindergarten_id">الروضة</label>
                        <select class="select2 form-select" id="kindergarten_id" name="kindergarten_id">
                            <option value="" disabled selected>اختر</option>
                            @foreach ($kindergartens as $kindergarten)
                                <option value="{{ $kindergarten->id }}">{{ $kindergarten->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="col-sm-12">
                    <label class="form-label" for="birth_date">تاريخ الميلاد</label>
                    <div class="input-group">
                        <input type="text" id="birth_date" name="birth_date" class="form-control" placeholder="YYYY-MM-DD" />
                        <span class="input-group-text">
                            <i class="ti ti-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="gender">الجنس</label>
                    <select class="select form-select" id="gender" name="gender">
                        <option value="" disabled selected>اختر</option>
                        <option value="0">ذكر</option>
                        <option value="1">أنثى</option>
                    </select>
                </div>
                @if ($role == 'Child')
                <div class="col-sm-12">
                    <label class="form-label" for="nationality">الجنسية</label>
                    <input type="text" id="nationality" name="nationality" class="form-control" placeholder="ليبية" />
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="address">العنوان</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="حي الاندلس، طرابلس" />
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="description">ملاحظات</label>
                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="أي ملاحظات طبية أو سلوكية..."></textarea>
                </div>
                @endif
                <div class="col-sm-12">
                    <label class="form-label" for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="********"/>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="password_confirmation">تاكيد كلمة المرور</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********" />
                </div>
                @if ($role == 'Child')
                <hr class="my-3" />
                <div id="parents-wrapper">
                    <div class="parent-group mb-3">
                        <div class="d-flex justify-content-between">
                            <h6>بيانات ولي الأمر</h6>

                            <button type="button" class="btn btn-sm bg-label-primary mb-3" id="add-parent-btn">
                                + إضافة ولي أمر
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">اسم ولي الامر</label>
                                <input type="text" name="parents[0][name]" class="form-control" placeholder="اسم ولي الامر" />
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label">صلة القرابة</label>
                                <input type="text" name="parents[0][relationship]" class="form-control" placeholder="أب، أم، ..." />
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label">رقم الهاتف</label>
                                <div class="input-group">
                                    <input type="text" name="parents[0][phone]" class="form-control phone-number-mask" placeholder="92XXXXXXX" maxlength="9"
                                    pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)"/>
                                    <span class="input-group-text">LY (+218)</span>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label">عنوان العمل</label>
                                <input type="text" name="parents[0][work_address]" class="form-control" placeholder="حي الاندلس، طرابلس" />
                            </div>
                        </div>
                    </div>

                    <hr class="my-3" />
                    <div class="parent-group mb-3 d-none" id="parent-1">
                        <div class="d-flex justify-content-between">
                            <h6> بيانات ولي الأمر الاضافي</h6>

                            <button type="button" class="btn btn-sm bg-label-danger mb-3" id="remove-parent-btn">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">اسم ولي الامر</label>
                                <input type="text" name="parents[1][name]" class="form-control" placeholder="اسم ولي الامر" />
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label">صلة القرابة</label>
                                <input type="text" name="parents[1][relationship]" class="form-control" placeholder="أب، أم، ..." />
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label">رقم الهاتف</label>
                                <div class="input-group">
                                    <input type="text" name="parents[1][phone]" class="form-control phone-number-mask" placeholder="92XXXXXXX" maxlength="9"
                                    pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)"/>
                                    <span class="input-group-text">LY (+218)</span>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label">عنوان العمل</label>
                                <input type="text" name="parents[1][work_address]" class="form-control" placeholder="حي الاندلس، طرابلس" />
                            </div>
                        </div>
                        <hr class="my-3" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="classroom_id">الفصل الدراسي</label>
                    <select class="select2 form-select" id="classroom_id" name="classroom_id">
                        <option value="" disabled selected>اختر</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}:{{ $classroom->level }} - {{ $classroom->kindergarten->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div class="mt-3 text-end">
                <button type="reset" class="btn btn-label-danger me-2" data-bs-dismiss="offcanvas">الغاء</button>
                <button type="submit" class="btn btn-primary data-submit">اضافة</button>
            </div>
        </form>
    </div>
</div>
