/**
 * Page User List
 */

'use strict';

$(function () {
    // Variable declaration for table
    var dt_user_table = $('.datatables-users'),
        offCanvasForm = $('#offcanvasAddUser'),
        roles = ['مدير روضة', 'معلم', 'ولي أمر'];

    // Users datatable
    if (dt_user_table.length) {
        var dt_user = dt_user_table.DataTable({
        processing: true,
        dom:
            '<"row "' +
            '<"col-md-2"<"ms-n2"l>>' +
            '<"col-md-10"<"text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"f>>' +
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
        });
    }

    // Role filter dropdown
    dt_user.columns(5)
    .every(function () {
        var column = this;
        var select = $('<select id="FilterRole" class="form-select"><option value="">الدور</option></select>')
            .appendTo('.user_role')
            .on('change', function () {
                var val = $(this).val();

                if (val) {
                    val = val.trim();
                    column.search('^\\s*' + val + '\\s*$', true, false).draw();
                } else {
                    column.search('', true, false).draw();
                }
            });

        roles.forEach(function (role) {
            select.append('<option value="' + role + '">' + role + '</option>');
        });
    });

    // restore archive
    $(document).on('click', '.restore-user', function () {
        var user_id = $(this).data('id');

        Swal.fire({
            text: 'هل انت متأكد من استرجاع هذا المستخدم؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم',
            cancelButtonText: 'اغلاق',
            customClass: {
                confirmButton: 'btn btn-warning me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                // Delete the data via AJAX
                $.ajax({
                    type: 'POST',
                    url: `${baseUrl}users/${user_id}/restore`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                    error: function (xhr) {
                        console.log(xhr);

                        Swal.fire({
                            icon: 'error',
                            text: xhr.responseJSON?.message,
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }

            });
            }
        });
    });

    // Filter form control to default size
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
    $('.dataTables_info').addClass('ms-n1');
    $('.dataTables_paginate').addClass('me-n1');
});
