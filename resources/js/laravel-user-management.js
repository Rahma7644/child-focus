/**
 * Page User List
 */

'use strict';

$(function () {
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
            title: 'هل انت متأكد؟',
            text: 'لا يمكنك التراجع عن حذف المستخدم',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
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
                                title: 'تم الحذف!',
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
                            title: 'خطأ',
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
        var userData = $(this).data('user');
        $('#userForm').data('mode', 'edit');
        $('#offcanvasAddUser').offcanvas('show');

        $('#first_name').val(userData.first_name);
        $('#second_name').val(userData.second_name);
        $('#last_name').val(userData.last_name);
        $('#email').val(userData.email);
        $('#phone').val(userData.phone);
        $('#gender').val(userData.gender);
        $('#birth_date').val(userData.birth_date);

        // Update form action to PUT
        $('#userForm').attr('action', `${baseUrl}users/${userData.id}`);
        $('#userForm').append('<input type="hidden" name="_method" value="PUT">');

        // Change title and button text
        $('#offcanvasAddUserLabel').text('تعديل المستخدم');
        $('.data-submit').text('تحديث');
    });

    offCanvasForm.on('hidden.bs.offcanvas', function () {
        fv.resetForm(true);

        // Reset form to POST
        $('#userForm').attr('action', `${baseUrl}users`);
        $('#userForm input[name="_method"]').remove();

        // reset gender value
        $('#gender').val('');
        // Reset title and button
        $('#offcanvasAddUserLabel').text('اضافة مستخدم');
        $('.data-submit').text('اضافة');

        $('#userForm').removeData('mode');
    });


    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);

    // validation
    const userForm = document.getElementById('userForm');
    const fv = FormValidation.formValidation(userForm, {
        fields: {
            first_name: {
            validators: {
                notEmpty: {
                    message: 'الاسم الاول مطلوب'
                    },
                    stringLength: {
                    min: 4,
                    max: 10,
                    message: 'الاسم الاول يجب ان يكون بين 4 و 10 أحرف'
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
                        min: 4,
                        max: 10,
                        message: 'الاسم الثاني يجب ان يكون بين 4 و 10 أحرف'
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
              }

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
        }
        }).on('core.form.valid', function () {
            userForm.submit();
        });

        // clearing form data when offcanvas hidden
        offCanvasForm.on('hidden.bs.offcanvas', function () {
            fv.resetForm(true);
        });

});
