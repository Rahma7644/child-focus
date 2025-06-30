'use strict';

$(function () {
    var select = $(
        `<select id="UserRole" class="form-select">
            <option value="open">مفتوح</option>
            <option value="active">قيد المعالجة</option>
            <option value="closed">مغلق</option>
            </select>`
        );

    var dt_invoice_table = $('.invoice-list-table');

    if (dt_invoice_table.length) {
        var dt_invoice = dt_invoice_table.DataTable({
        order: [[2, 'desc']],
        processing: true,
        dom:
            '<"row mx-1"' +
            '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start">>' +
            '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-5 gap-md-4 mt-n6 mt-md-0"f<"invoice_status mb-6 mb-md-0">>' +
            '>t' +
            '<"row mx-1"' +
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
        initComplete: function () {

            setTimeout(() => {
                $('#DataTables_Table_0_filter input').removeClass('form-control-sm');
                $('#DataTables_Table_0_length select').removeClass('form-select-sm');
                $('#DataTables_Table_0_info').addClass('ms-n1');
                $('#DataTables_Table_0_paginate').addClass('me-n1');
                }, 50);


    // Manual status filter like user roles
    const statuses = ['مفتوح', 'قيد المعالجة', 'مغلق'];

    this.api().columns(4) // status column index in your Blade
        .every(function () {
            var column = this;
            var select = $('<select id="FilterStatus" class="form-select"><option value="">الحالة</option></select>')
                .appendTo('.invoice_status')
                .on('change', function () {
                    var val = $(this).val();
                    if (val) {
                        val = val.trim();
                        column.search('^\\s*' + val + '\\s*$', true, false).draw();
                    } else {
                        column.search('', true, false).draw();
                    }
                });

            statuses.forEach(function (status) {
                select.append('<option value="' + status + '">' + status + '</option>');
            });
        });
    }
    });
    }

});
