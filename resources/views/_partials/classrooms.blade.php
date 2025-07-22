<div class="modal fade" id="classModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-class">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form id="classForm" class="row g-6" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h5 class="my-3">بيانات الفصل الدراسي</h5>
                    <div class="row mb-3 mt-0 g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="kindergarten_id">الروضة</label>
                            <select id="kindergarten_id" name="kindergarten_id" class="selectpicker w-auto" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white" autofocus>
                                @php
                                    $kindergartens = App\Models\Kindergarten::all();
                                @endphp
                                <option value="" disabled selected>اختر</option>
                                @foreach ( $kindergartens as $kindergarten )
                                    <option value="{{ $kindergarten->id }}" data-public="{{ $kindergarten->is_public }}"> {{ $kindergarten->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="name">الاسم</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="اسم الفصل الدراسي" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="level">المستوى الدراسي</label>
                            <select id="level" name="level" class="select2 form-select" disabled>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="capacity">السعة</label>
                                <input type="text" id="capacity" name="capacity" class="form-control phone-number-mask" placeholder="عدد الاطفال"
                                    maxlength="2" pattern="\d*" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)" />
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="image">صورة الفصل الدراسي</label>

                            <div class="position-relative">
                                <input type="file" name="image" id="image" class="form-control pe-5" accept="image/*" />
                                <img id="logoPreview" src="" alt="صورة الفصل الدراسي"
                                    class="position-absolute end-0 top-50 translate-middle-y me-2 rounded"
                                    style="width: 32px; height: 32px; object-fit: cover; display: none;" />
                            </div>

                            <small id="logoNote" class="text-muted mt-1">قم برفع صورة الفصل الدراسي إن وجدت.</small>
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label" for="description">الوصف</label>
                            <textarea id="description" name="description" class="form-control" placeholder="وصف الفصل الدراسي"></textarea>
                        </div>
                    </div>

                    <hr class="my-4" />
                    @php
                        $teachers = App\Models\Teacher::all();
                    @endphp
                    <!-- teacher Section -->
                    <h5 class="my-3">معلم الفصل الدراسي</h5>
                    <div class="row mb-3 mt-0 g-3">
                        <div class="col-sm-12">
                            <div class="d-flex align-items-center gap-2">
                                <div id="userSelectWrapper" class="flex-grow-1">
                                    <label id="teacherLabel" class="form-label" for="teacher_id">معلم الفصل</label>
                                    <select id="teacher_id" name="teacher_id" class="select2 form-select ">
                                        <option value="" disabled selected>اختر</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->user->first_name }} {{ $teacher->user->last_name }} - {{ $teacher->user->email }}
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
                        <button type="submit" class="btn btn-primary me-2">اضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
