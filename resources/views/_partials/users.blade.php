<!-- Offcanvas to add new user -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title"> اضافة {{ $role == 'Manager' ? 'مسؤول روضة' : ($role == 'Teacher' ? 'معلم' : ($role == 'Parent' ? 'ولي أمر' : 'مستخدم')) }}
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="add-new-user pt-0" id="userForm" method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="row mb-6 g-6">
                <input type="hidden" name="role" value="{{$role}}" />
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
                <div class="col-sm-12">
                    <label class="form-label" for="gender">الجنس</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="" disabled selected>اختر</option>
                        <option value="0">ذكر</option>
                        <option value="1">أنثى</option>
                    </select>

                </div>
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
                    <label class="form-label" for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="********"/>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="password_confirmation">تاكيد كلمة المرور</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-3 data-submit">اضافة</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">الغاء</button>
        </form>
    </div>
</div>
