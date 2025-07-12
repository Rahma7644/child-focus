/**
 * Page User List
 */

'use strict';

$(function () {
    const selectPicker = $('.selectpicker'),
    select2 = $('.select2'),
    flatpickrDisabledRange = document.querySelector('#birth_date'),
    toggleBtn = $('#toggleAddUserBtn'),
    newUserFields = $('#newUserFields'),
    userSelect = $('#manager_id'),
    managerLabel = $('#managerLabel');

    let previousManagerId = null;

    if (selectPicker.length) {
        selectPicker.selectpicker();
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

    toggleBtn.on('click', function () {
        const icon = $(this).find('i');
        const creatingNewManager = newUserFields.is(':hidden');

        if (creatingNewManager) {
            newUserFields.slideDown();
            userSelect.val('').trigger('change');

            userSelect.next('.select2-container').hide();
            fvKg.updateFieldStatus('manager_id', 'NotValidated');

            managerLabel.text('اضافة مدير روضة جديد').addClass('fs-6');

            toggleBtn.removeClass('bg-label-primary mt-6').addClass('bg-label-danger');
            icon.removeClass('ti-user-plus').addClass('ti-x');
        } else {
            newUserFields.slideUp();
            userSelect.next('.select2-container').show();

            newUserFields.find('input, select').val('');
            managerLabel.text('مدير الروضة').removeClass('fs-6');

            if (previousManagerId) {
                userSelect.val(previousManagerId).trigger('change');
            }

            toggleBtn.removeClass('bg-label-danger').addClass('bg-label-primary mt-6');
            icon.removeClass('ti-x').addClass('ti-user-plus ');
        }
    });

    // Variable declaration for table
    var dt_user_table = $('.datatables-users'),
        offCanvasForm = $('#offcanvasAddUser');

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
        // Buttons
        buttons: [
            {
            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">اضافة روضة</span>',
            className: 'add-new btn btn-primary waves-effect waves-light mx-2',
            attr: {
                'data-bs-toggle': 'modal',
                'data-bs-target': '#kgModal'
            }
            }
        ],

        // status filter
        initComplete: function () {
            const api = this.api();
            const column = api.column(6);

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
        }

        });
    }

    // edit record
    $(document).on('click', '.edit-record', function () {
        var kgData = $(this).data('kg');
        $('#kgModal').modal('show');

        previousManagerId = kgData.manager_id;

        $('#kgName').val(kgData.name);
        $('#kgLocation').val(kgData.address);
        $('#kgPhone').val(kgData.phone);
        $('#manager_id').val(kgData.manager_id).trigger('change');

        if (kgData.logo) {
            $('#logoPreview').attr('src', `/storage/${kgData.logo}`).show();
            $('#logoNote').hide();

        } else {
            $('#logoPreview').hide();
            $('#logoNote').show();
        }

        $('#newUserFields').hide();

        $('#kgForm').attr('action', `${baseUrl}kindergartens/${kgData.id}`);
        if (!$('#kgForm input[name="_method"]').length) {
            $('#kgForm').append('<input type="hidden" name="_method" value="PUT">');
        }

        $('.btn[type=submit]').text('تحديث');
    });

    // reset form
    $('#kgModal').on('hidden.bs.modal', function () {
    $('#kgForm')[0].reset();
    $('#kgForm input[name="_method"]').remove();
    $('#manager_id').val('').trigger('change');
    $('#gender').val('').trigger('change');
    $('#logoPreview').hide();
    $('#logoNote').show();
    $('#newUserFields').hide();
    $('.btn[type=submit]').text('اضافة');
    fvKg.resetForm(true);
});



    // toggle status
    $(document).on('click', '.toggle-status', function () {
        let $btn = $(this);
        let userId = $btn.data('id');
        let currentStatus = $btn.data('status');
        let actionText = currentStatus === 'active' ? 'تعطيل' : 'تفعيل';

        Swal.fire({
            text: `هل أنت متأكد أنك تريد ${actionText} الروضة؟`,
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
                            text: 'فشل في تغيير حالة الروضة',
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

const kgForm = document.getElementById('kgForm');
const fvKg = FormValidation.formValidation(kgForm, {
    fields: {
        // Kindergarten fields
        kgName: {
            validators: {
                notEmpty: {
                    message: 'اسم الروضة مطلوب'
                }
            }
        },
        kgLocation: {
            validators: {
                notEmpty: {
                    message: 'عنوان الروضة مطلوب'
                }
            }
        },
        kgPhone: {
            validators: {
                notEmpty: {
                    message: 'رقم الهاتف مطلوب'
                },
                regexp: {
                    regexp: /^[0-9]{9}$/,
                    message: 'رقم الهاتف يجب أن يتكون من 9 أرقام'
                }
            }
        },
        kgLogo: {
            validators: {
                file: {
                    extension: 'jpg,jpeg,png,gif,webp',
                    type: 'image/jpeg,image/png,image/gif,image/webp',
                    message: 'صيغة الملف غير صحيحة. الرجاء رفع صورة'
                }
            }
        },
        manager_id: {
            validators: {
                callback: {
                    message: 'الرجاء اختيار مدير الروضة',
                    callback: function(input) {
                    const isSelect2Hidden = $('#manager_id').next('.select2-container').css('display') === 'none';
                    const hasValue = input.value !== '';
                    return isSelect2Hidden || hasValue;
                    }
                }
                }
            },


        // Manager fields (conditionally required)
        first_name: {
            validators: {
                callback: {
                    message: 'الاسم الاول مطلوب',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
                }
            }
        },
        second_name: {
            validators: {
                callback: {
                    message: 'الاسم الثاني مطلوب',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
                }
            }
        },
        last_name: {
            validators: {
                callback: {
                    message: 'اللقب مطلوب',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
                }
            }
        },
        email: {
            validators: {
                callback: {
                    message: 'البريد الالكتروني مطلوب',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
                },
                emailAddress: {
                    message: 'البريد الالكتروني غير صالح'
                }
            }
        },
        phone: {
            validators: {
                callback: {
                    message: 'رقم الهاتف مطلوب',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
                }
            }
        },
        gender: {
            validators: {
                callback: {
                    message: 'الرجاء اختيار الجنس',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim() !== '' : true;
                    }
                }
            }
        },
        birth_date: {
            validators: {
                callback: {
                    message: 'الرجاء اختيار تاريخ الميلاد',
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
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
                    callback: function (input) {
                        return $('#newUserFields').is(':visible') ? input.value.trim().length > 0 : true;
                    }
                }
            }
        },
        password_confirmation: {
            validators: {
                callback: {
                    message: 'تأكيد كلمة المرور مطلوب',
                    callback: function (input) {
                        if (!$('#newUserFields').is(':visible')) return true;

                        const passwordValue = kgForm.querySelector('[name="password"]').value;
                        return input.value.trim().length > 0 && input.value === passwordValue;
                    }
                },
                identical: {
                    compare: function () {
                        return kgForm.querySelector('[name="password"]').value;
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
            rowSelector: '.col-sm-12, .col-sm-6, .col-sm-4'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()

    }
}).on('core.form.valid', function () {
    kgForm.submit();
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
    }
});
