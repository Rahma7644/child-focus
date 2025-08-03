/**
 * Page User List
 */

'use strict';

$(function () {
    const select2 = $('.select2'),
        selectPicker = $('.selectpicker'),
        flatpickrDisabledRange = document.querySelector('#birth_date');

        if (selectPicker.length) {
            selectPicker.selectpicker()
        }

        if (select2.length) {
            select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'اختر',
                dropdownParent: $this.parent()
            });
        });
    }
    // Variable declaration for table
    var dt_user_table = $('.datatables-users'),
        offCanvasForm = $('#offcanvasAddUser'),
        statuses = ['مفعل', 'غير مفعل'];

    // Users datatable
    if (dt_user_table.length) {
        var dt_user = dt_user_table.DataTable({
        processing: true,
        dom:
            '<"row"' +
            '<"col-md-2"<"ms-n2"l>>' +
            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"fB>>' +
            '>t' +
            '<"row"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        lengthMenu: [10, 20, 50, 70, 100],
        language: {
            sLengthMenu: '_MENU_',
            search: '',
            searchPlaceholder: 'بحث',
            info: 'عرض من _START_ إلى _END_ من أصل _TOTAL_ سجلات',
            infoEmpty: 'عرض 0 إلى 0 من أصل 0 سجلات',
            infoFiltered: '(تمت التصفية من إجمالي _MAX_ )',
            zeroRecords: 'لم يتم العثور على سجلات مطابقة',
            emptyTable: 'لا توجد بيانات متاحة',
            paginate: {
            next: '<i class="ti ti-chevron-right ti-sm"></i>',
            previous: '<i class="ti ti-chevron-left ti-sm"></i>'
            }
        },
        // Buttons with Dropdown
        buttons: [
            {
            extend: 'collection',
            className: 'btn btn-label-secondary dropdown-toggle mx-4 waves-effect waves-light',
            text: '<i class="ti ti-upload me-2 ti-xs"></i>Export',
            buttons: [
                {
                extend: 'print',
                title: 'Users',
                text: '<i class="ti ti-printer me-2" ></i>Print',
                className: 'dropdown-item',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5],
                    // prevent avatar to be print
                    format: {
                    body: function (inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                        } else result = result + item.innerText;
                        });
                        return result;
                    }
                    }
                },
                customize: function (win) {
                    //customize print view for dark
                    $(win.document.body)
                    .css('color', config.colors.headingColor)
                    .css('border-color', config.colors.borderColor)
                    .css('background-color', config.colors.body);
                    $(win.document.body)
                    .find('table')
                    .addClass('compact')
                    .css('color', 'inherit')
                    .css('border-color', 'inherit')
                    .css('background-color', 'inherit');
                }
                },
                {
                extend: 'csv',
                title: 'Users',
                text: '<i class="ti ti-file-text me-2" ></i>Csv',
                className: 'dropdown-item',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5],
                    // prevent avatar to be display
                    format: {
                    body: function (inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                        } else result = result + item.innerText;
                        });
                        return result;
                    }
                    }
                }
                },
                {
                extend: 'excel',
                title: 'Users',
                text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                className: 'dropdown-item',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5],
                    // prevent avatar to be display
                    format: {
                    body: function (inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                        } else result = result + item.innerText;
                        });
                        return result;
                    }
                    }
                }
                },
                {
                extend: 'pdf',
                title: 'Users',
                text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                className: 'dropdown-item',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5],
                    // prevent avatar to be display
                    format: {
                    body: function (inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                            result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                        } else result = result + item.innerText;
                        });
                        return result;
                    }
                    }
                }
                },
            ]
            },
            {
            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">اضافة مستخدم</span>',
            className: 'add-new btn btn-primary waves-effect waves-light',
            attr: {
                'data-bs-toggle': 'offcanvas',
                'data-bs-target': '#offcanvasAddUser'
            }
            }
        ],

        // Status filter
        initComplete: function () {
            const api = this.api();
            const column = api.column(7);

            const $container = $('.user_status');

            const select = $(`
                <select id="FilterTransaction" class="selectpicker w-auto"
                    data-style="btn-transparent"
                    data-icon-base="ti"
                    data-tick-icon="ti-check text-white">
                    <option value="">الحالة</option>
                </select>
            `).appendTo($container);

            const statuses = ['مفعل', 'غير مفعل'];
            statuses.forEach(status => {
                select.append(`<option value="${status}">${status}</option>`);
            });

            select.on('change', function () {
                const val = $(this).val();
                column.search(val ? '^\\s*' + val.trim() + '\\s*$' : '', true, false).draw();
            });

            select.selectpicker();
        },
        // For responsive popup
        responsive: {
            details: {
            display: $.fn.dataTable.Responsive.display.modal({
                header: function (row) {
                var data = row.data();
                return 'Details of ' + data['name'];
                }
            }),
            type: 'column',
            renderer: function (api, rowIdx, columns) {
                var data = $.map(columns, function (col, i) {
                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                    ? '<tr data-dt-row="' +
                        col.rowIndex +
                        '" data-dt-column="' +
                        col.columnIndex +
                        '">' +
                        '<td>' +
                        col.title +
                        ':' +
                        '</td> ' +
                        '<td>' +
                        col.data +
                        '</td>' +
                        '</tr>'
                    : '';
                }).join('');

                return data ? $('<table class="table"/><tbody />').append(data) : false;
            }
            }
        }
        });
    }

    // Delete Record
    $(document).on('click', '.delete-record', function () {
        var user_id = $(this).data('id');

        Swal.fire({
            text: 'هل انت متأكد من أرشفة هذا المستخدم؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم',
            cancelButtonText: 'إلغاء',
            customClass: {
                confirmButton: 'btn btn-warning me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
            }).then(function (result) {
            if (result.value) {
                // Delete the data via AJAX
                $.ajax({
                    type: 'DELETE',
                    url: `${baseUrl}users/${user_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                    },
                    success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                }
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }
                });
            }
        });
    });

    // edit record
    $(document).on('click', '.edit-record', function () {
    const userData = $(this).data('user');

    $('#userForm').data('mode', 'edit');
    $('#offcanvasAddUser').offcanvas('show');

    const user = userData.user;

    $('#first_name').val(user.first_name);
    $('#second_name').val(user.second_name);
    $('#last_name').val(user.last_name);
    $('#email').val(user.email);
    $('#phone').val(user.phone);
    $('#gender').val(user.gender);
    $('#birth_date').val(user.birth_date);

    // Role-specific fields
    if (userData.role === 'Teacher') {
        $('#specialization').val(userData.teacher?.specialization ?? '');
        $('#kindergarten_id').val(userData.teacher?.kindergarten_id ?? '').trigger('change');
    } else if (userData.role === 'Child') {
        $('#classroom_id').val(userData.child?.classroom_id ?? '').trigger('change');
        $('#nationality').val(userData.child?.nationality ?? '');
        $('#address').val(userData.child?.address ?? '');
        $('#description').val(userData.child?.description ?? '');
        // Fill in parent data
        const parents = userData.parents ?? [];
        // First parent
        if (parents[0]) {
            $('[name="parents[0][name]"]').val(parents[0].name);
            $('[name="parents[0][relationship]"]').val(parents[0].relationship);
            $('[name="parents[0][phone]"]').val(parents[0].phone);
            $('[name="parents[0][work_address]"]').val(parents[0].work_address);
        }
        // Second parent
        if (parents[1]) {
            $('#parent-1').removeClass('d-none'); // show the second parent block
            $('[name="parents[1][name]"]').val(parents[1].name);
            $('[name="parents[1][relationship]"]').val(parents[1].relationship);
            $('[name="parents[1][phone]"]').val(parents[1].phone);
            $('[name="parents[1][work_address]"]').val(parents[1].work_address);
        } else {
            // Clear second parent fields and hide the block if not used
            $('#parent-1').addClass('d-none');
            $('[name="parents[1][name]"]').val('');
            $('[name="parents[1][relationship]"]').val('');
            $('[name="parents[1][phone]"]').val('');
            $('[name="parents[1][work_address]"]').val('');
        }
    }else {
        $('#specialization').val('');
        $('#kindergarten_id').val(null).trigger('change');
    }

    // Update form action and method
    $('#userForm').attr('action', `${baseUrl}users/${user.id}`);
    if (!$('#userForm input[name="_method"]').length) {
        $('#userForm').append('<input type="hidden" name="_method" value="PUT">');
    }

    // UI updates
    $('#offcanvasAddUserLabel').text('تعديل المستخدم');
    $('.data-submit').text('تحديث');
    });


    //reset
    offCanvasForm.on('hidden.bs.offcanvas', function () {
        fv.resetForm(true);

        // Reset form to POST
        $('#userForm').attr('action', `${baseUrl}users`);
        $('#userForm input[name="_method"]').remove();

        $('#kindergarten_id').val('').trigger('change');
        $('#gender').val('');
        // Reset title and button
        $('#offcanvasAddUserLabel').text('اضافة مستخدم');
        $('.data-submit').text('اضافة');

        $('#userForm').removeData('mode');
    });

    //parents info
    const $addParentBtn = $('#add-parent-btn');
    const $secondParent = $('#parent-1');
    const $removeParentBtn = $('#remove-parent-btn');

    $addParentBtn.on('click', function () {
        $secondParent.removeClass('d-none');
        $addParentBtn.prop('disabled', true);
    });

    $removeParentBtn.on('click', function () {
        $secondParent.find('input').val('');
        $secondParent.addClass('d-none');
        $addParentBtn.prop('disabled', false);
    });

    // toggle status
    $(document).on('click', '.toggle-status', function () {
        let $btn = $(this);
        let userId = $btn.data('id');
        let currentStatus = $btn.data('status');
        let actionText = currentStatus === 'active' ? 'تعطيل' : 'تفعيل';

        Swal.fire({
            text: `هل أنت متأكد أنك تريد ${actionText} هذا المستخدم؟`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم',
            cancelButtonText: 'إلغاء',
            customClass: {
                confirmButton: 'btn btn-warning me-3',
                cancelButton: 'btn btn-label-secondary'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/users/${userId}/status`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(result => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            text: 'فشل في تغيير حالة المستخدم',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }
                });
            }
        });
    });

    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);

    // validation
    const userForm = document.getElementById('userForm');
    const role = userForm.querySelector('[name="role"]').value;
    const fv = FormValidation.formValidation(userForm, {
        fields: {
            first_name: {
            validators: {
                notEmpty: {
                    message: 'الاسم الاول مطلوب'
                    },
                    stringLength: {
                    min: 2,
                    max: 10,
                    message: 'الاسم الاول يجب ان يكون بين 2 و 10 أحرف'
                    },
                    regexp: {
                        regexp: /^[\u0600-\u06FFa-zA-Z\s]+$/,
                        message: 'الاسم الاول يجب ان يتكون من الاحرف فقط'
                    }
                }
            },
            second_name: {
                validators: {
                    notEmpty: {
                        message: 'الاسم الثاني مطلوب'
                        },
                        stringLength: {
                        min: 2,
                        max: 10,
                        message: 'الاسم الثاني يجب ان يكون بين 2 و 10 أحرف'
                        },
                        regexp: {
                            regexp: /^[\u0600-\u06FFa-zA-Z\s]+$/,
                            message: 'الاسم الثاني يجب ان يتكون من الاحرف فقط'
                        }
                    }
            },
            last_name: {
            validators: {
                notEmpty: {
                    message: 'اللقب مطلوب'
                    },
                    stringLength: {
                    min: 4,
                    max: 10,
                    message: 'اللقب يجب ان يكون بين 4 و 10 أحرف'
                    },
                    regexp: {
                        regexp: /^[\u0600-\u06FFa-zA-Z\s]+$/,
                        message: 'اللقب يجب ان يتكون من الاحرف فقط'
                    }
                }
            },
            email: {
            validators: {
                notEmpty: {
                message: 'البريد الالكتروني مطلوب'
                },
                emailAddress: {
                message: 'البريد الالكتروني غير صالح'
                }
            }
            },
            phone: {
            validators: {
                notEmpty: {
                message: 'رقم الهاتف مطلوب'
                }
            }
            },
            gender: {
            validators: {
                notEmpty: {
                message: 'الرجاء اختيار الجنس'
                }
            }
            },
            birth_date: {
                validators: {
                    notEmpty: {
                    message: 'الرجاء اختيار تاريخ الميلاد'
                    },
                    date: {
                    format: 'YYYY-MM-DD',
                    message: 'صيغة التاريخ غير صحيحة. يجب أن تكون مثل 2025-01-01'
                    }
                }
            },
            password: {
                validators: {
                    callback: {
                        message: 'كلمة المرور مطلوبة',
                        callback: function(input) {
                        // If mode is 'edit', password is optional
                        if ($('#userForm').data('mode') === 'edit') {
                            return true; // skip validation on edit
                        }
                        // Otherwise (add mode), password is required
                        return input.value.trim().length > 0;
                        }
                    }
                    }
                },
                password_confirmation: {
                    validators: {
                    callback: {
                        message: 'تأكيد كلمة المرور مطلوب',
                        callback: function(input) {
                        if ($('#userForm').data('mode') === 'edit') {
                            return true; // skip validation on edit
                        }
                        const passwordValue = userForm.querySelector('[name="password"]').value;
                        return input.value.trim().length > 0 && input.value === passwordValue;
                        }
                    },
                    identical: {
                        compare: function() {
                        return userForm.querySelector('[name="password"]').value;
                        },
                        message: 'كلمات المرور غير متطابقة'
                    }
                    }
                },
                // Teacher fields
                kindergarten_id: {
                    validators: {
                        callback: {
                            message: 'الرجاء اختيار الروضة',
                            callback: function (input) {
                                return role !== 'Teacher' || input.value.trim() !== '';
                            }
                        }
                    }
                },
                specialization: {
                    validators: {
                        callback: {
                            message: 'التخصص مطلوب',
                            callback: function (input) {
                                return role !== 'Teacher' || input.value.trim().length > 0;
                            }
                        },
                        stringLength: {
                            max: 55,
                            message: 'يجب ألا يتجاوز التخصص 55 حرفاً'
                        },
                        regexp: {
                            regexp: /^[\u0600-\u06FFa-zA-Z\s]+$/,
                            message: 'التخصص يجب أن يحتوي على حروف فقط'
                        }
                    }
                },
                //child fields
                classroom_id: {
                    validators: {
                        callback: {
                            message: 'الرجاء اختيار الفصل الدراسي',
                            callback: function(input) {
                                return role !== 'Child' || input.value.trim() !== '';
                            }
                        }
                    }
                },
                address: {
                    validators: {
                        callback: {
                            message: 'العنوان مطلوب',
                            callback: function(input) {
                                return role !== 'Child' || input.value.trim() !== '';
                            }
                        },
                        stringLength: {
                            max: 255,
                            message: 'العنوان يجب ألا يتجاوز 255 حرفاً'
                        }
                    }
                },
                nationality: {
                    validators: {
                        callback: {
                            message: 'الجنسية مطلوبة',
                            callback: function(input) {
                                return role !== 'Child' || input.value.trim() !== '';
                            }
                        },
                        stringLength: {
                            max: 100,
                            message: 'الجنسية يجب ألا يتجاوز 100 حرفاً'
                        }
                    }
                },
                description: {
                    validators: {
                        stringLength: {
                            max: 500,
                            message: 'الملاحظات يجب ألا تتجاوز 225 حرفاً'
                        }
                    }
                },

                // Parents fields: Validate at least the first parent is fully filled, second parent optional

                'parents[0][name]': {
                    validators: {
                        callback: {
                            message: 'اسم ولي الأمر الأول مطلوب',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                return input.value.trim().length > 0;
                            }
                        },
                        stringLength: {
                            max: 100,
                            message: 'اسم ولي الأمر يجب ألا يتجاوز 100 حرفاً'
                        }
                    }
                },

                'parents[0][relationship]': {
                    validators: {
                        callback: {
                            message: 'صلة القرابة لولي الأمر الأول مطلوبة',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                return input.value.trim().length > 0;
                            }
                        },
                        stringLength: {
                            max: 100,
                            message: 'صلة القرابة يجب ألا تتجاوز 100 حرف.'
                        }
                    }
                },

                'parents[0][phone]': {
                    validators: {
                        callback: {
                            message: 'رقم الهاتف لولي الأمر الأول مطلوب ',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                return /^\d{9}$/.test(input.value.trim());
                            }
                        }
                    }
                },

                'parents[0][work_address]': {
                    validators: {
                        callback: {
                            message: 'عنوان العمل لولي الأمر الأول مطلوبة',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                return input.value.trim().length > 0;
                            }
                        },
                        stringLength: {
                            max: 100,
                            message: 'عنوان العمل يجب ألا يتجاوز 100 حرف.'
                        }
                    }
                },

                // Second parent - optional but if filled, fields must be valid

                'parents[1][name]': {
                    validators: {
                        callback: {
                            message: 'اسم ولي الأمر الثاني غير صالح',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                if (input.value.trim() === '') return true;
                                return input.value.trim().length <= 100;
                            }
                        }
                    }
                },

                'parents[1][relationship]': {
                    validators: {
                        callback: {
                            message: 'صلة القرابة لولي الأمر الثاني غير صالحة',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                if (input.value.trim() === '') return true;
                                return input.value.trim().length <= 100;
                            }
                        }
                    }
                },

                'parents[1][phone]': {
                    validators: {
                        callback: {
                            message: 'رقم الهاتف لولي الأمر الثاني يجب أن يكون 9 أرقام',
                            callback: function(input) {
                                if (role !== 'Child') return true;
                                if (input.value.trim() === '') return true; // optional
                                return /^\d{9}$/.test(input.value.trim());
                            }
                        }
                    }
                },

                'parents[1][work_address]': {
                    validators: {
                        stringLength: {
                            max: 255,
                            message: 'عنوان العمل يجب ألا يتجاوز 255 حرفاً'
                        }
                    }
                },

        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
            // Use this for enabling/changing valid/invalid class
            // eleInvalidClass: '',
            eleValidClass: '',
            rowSelector: '.col-sm-12, .col-sm-4'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        }).on('core.form.valid', function () {
            userForm.submit();
        });

        // clearing form data when offcanvas hidden
        offCanvasForm.on('hidden.bs.offcanvas', function () {
            fv.resetForm(true);
        });

        if (flatpickrDisabledRange) {
            const fromDate = new Date(Date.now() - 3600 * 1000 * 48);
            const toDate = new Date(Date.now() + 3600 * 1000 * 48);

            flatpickrDisabledRange.flatpickr({
            dateFormat: 'Y-m-d',
            disable: [
                {
                from: fromDate.toISOString().split('T')[0],
                to: toDate.toISOString().split('T')[0]
                }
            ]
            });
        };


    const passForm = document.getElementById('passForm');
    const fp = FormValidation.formValidation(passForm, {
        fields: {
            password: {
                validators: {
                    callback: {
                        message: 'كلمة المرور مطلوبة',
                        callback: function(input) {
                            return input.value.trim().length > 0;
                        }
                    }
                    }
                },
                password_confirmation: {
                    validators: {
                    callback: {
                        message: 'تأكيد كلمة المرور مطلوب',
                        callback: function(input) {
                        const passwordValue = passForm.querySelector('[name="password"]').value;
                        return input.value.trim().length > 0 && input.value === passwordValue;
                        }
                    },
                    identical: {
                        compare: function() {
                        return passForm.querySelector('[name="password"]').value;
                        },
                        message: 'كلمات المرور غير متطابقة'
                    }
                    }
                }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
            // Use this for enabling/changing valid/invalid class
            // eleInvalidClass: '',
            eleValidClass: '',
            rowSelector: '.col-sm-6'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        }).on('core.form.valid', function () {
            passForm.submit();
        });

        // clearing form data when offcanvas hidden
        offCanvasForm.on('hidden.bs.offcanvas', function () {
            fp.resetForm(true);
        });
});
