<div class="modal fade" id="classModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-class">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form id="classForm" class="row g-6" action="{{ route('classrooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h5 class="my-3">بيانات الفصل الدراسي</h5>
                    <div class="row mb-3 mt-0 g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="kindergarten_id">الروضة</label>
                            <select id="kindergarten_id" name="kindergarten_id" class="selectpicker w-auto" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white" autofocus>
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
                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-label-danger me-2" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary me-2">اضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
