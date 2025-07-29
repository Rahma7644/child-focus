'use strict';


$(function () {

    const selectPicker = $('.selectpicker'),
    select2 = $('.select2'),
    flatpickrDisabledRange = document.querySelector('#birth_date'),
    toggleBtn = $('#toggleAddUserBtn'),
    newUserFields = $('#newUserFields'),
    userSelect = $('#teacher_id'),
    teacherLabel = $('#teacherLabel');


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
        const creatingNewTeacher = newUserFields.is(':hidden');

        if (creatingNewTeacher) {
            newUserFields.slideDown();
            userSelect.val('').trigger('change');

            userSelect.next('.select2-container').hide();
            fv.updateFieldStatus('teacher_id', 'NotValidated');

            teacherLabel.text('اضافة معلم جديد').addClass('fs-6');

            toggleBtn.removeClass('bg-label-primary mt-6').addClass('bg-label-danger');
            icon.removeClass('ti-user-plus').addClass('ti-x');
        } else {
            newUserFields.slideUp();
            userSelect.next('.select2-container').show();

            newUserFields.find('input, select').val('');
            teacherLabel.text('المعلم').removeClass('fs-6');

            toggleBtn.removeClass('bg-label-danger').addClass('bg-label-primary mt-6');
            icon.removeClass('ti-x').addClass('ti-user-plus ');
        }
    });

    // reset form
    $('#addTeacherModal').on('hidden.bs.modal', function () {
        $('#ctForm')[0].reset();
        $('#teacher_id').val('').trigger('change');
        $('#gender').val('').trigger('change');
        $('#newUserFields').hide();
        fv.resetForm(true);
    });

    $(document).on('click', '.remove-teacher', function () {
    const classroomId = $(this).data('classroom-id');
    const teacherId = $(this).data('teacher-id');

    Swal.fire({
        text: 'هل أنت متأكد من إزالة المعلم من هذا الفصل؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم',
        cancelButtonText: 'إلغاء',
        customClass: {
            confirmButton: 'btn btn-warning me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: `/classrooms/${classroomId}/teachers/${teacherId}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        text: response.message || 'تمت إزالة المعلم بنجاح',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            location.reload(); 
                        }
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message || 'حدث خطأ أثناء الإزالة',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            });
        }
    });
});


    const form = document.getElementById('ctForm');
    const fv = FormValidation.formValidation(form, {
        fields: {
            teacher_id: {
                validators: {
                    callback: {
                        message: 'الرجاء اختيار معلم الفصل',
                        callback: function(input) {
                        const isSelect2Hidden = $('#teacher_id').next('.select2-container').css('display') === 'none';
                        const hasValue = input.value !== '';
                        return isSelect2Hidden || hasValue;
                        }
                    }
                    }
                },
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
            specialization: {
                validators: {
                    callback: {
                        message: 'التخصص مطلوب',
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

                            const passwordValue = form.querySelector('[name="password"]').value;
                            return input.value.trim().length > 0 && input.value === passwordValue;
                        }
                    },
                    identical: {
                        compare: function () {
                            return form.querySelector('[name="password"]').value;
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
        form.submit();
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
