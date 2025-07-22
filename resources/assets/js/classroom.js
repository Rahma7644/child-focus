    'use strict';

    $(function () {
    const selectPicker = $('.selectpicker'),
    select2 = $('.select2'),
    flatpickrDisabledRange = document.querySelector('#birth_date'),
    toggleBtn = $('#toggleAddUserBtn'),
    newUserFields = $('#newUserFields'),
    userSelect = $('#teacher_id'),
    teacherLabel = $('#teacherLabel');
$(function () {
    const $kgSelect = $('#kindergarten_id');
    const $levelSelect = $('#level');

    const levels = {
        public: [
            { value: 'grade1', text: 'أساسي 1' },
            { value: 'grade2', text: 'أساسي 2' },
            { value: 'grade3', text: 'أساسي 3' }
        ],
        private: [
            { value: 'kg1', text: 'تمهيدي 1' },
            { value: 'kg2', text: 'تمهيدي 2' },
            { value: 'kg3', text: 'تمهيدي 3' }
        ]
    };

    $kgSelect.on('change', function () {
        const selectedOption = $(this).find('option:selected');
        const isPublic = selectedOption.data('public') === 1 || selectedOption.data('public') === '1';
        const levelType = isPublic ? 'public' : 'private';
        const options = levels[levelType];

        // Clear and repopulate
        $levelSelect.prop('disabled', false);
        $levelSelect.empty().append('<option value="" disabled selected>اختر</option>');

        options.forEach(opt => {
            $levelSelect.append(new Option(opt.text, opt.value));
        });

        $levelSelect.trigger('change.select2');
    });
});


    let previousTeacherId = null;

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
            fvClass.updateFieldStatus('teacher_id', 'NotValidated');

            teacherLabel.text('اضافة معلم جديد').addClass('fs-6');

            toggleBtn.removeClass('bg-label-primary mt-6').addClass('bg-label-danger');
            icon.removeClass('ti-user-plus').addClass('ti-x');
        } else {
            newUserFields.slideUp();
            userSelect.next('.select2-container').show();

            newUserFields.find('input, select').val('');
            teacherLabel.text('معلم الفصل الدراسي').removeClass('fs-6');

            if (previousTeacherId) {
                userSelect.val(previousTeacherId).trigger('change');
            }

            toggleBtn.removeClass('bg-label-danger').addClass('bg-label-primary mt-6');
            icon.removeClass('ti-x').addClass('ti-user-plus ');
        }
    });


    // reset form
    $('#classModal').on('hidden.bs.modal', function () {
    $('#classForm')[0].reset();
    $('#teacher_id').val('').trigger('change');
    $('#gender').val('').trigger('change');
    $('#newUserFields').hide();
    $('.btn[type=submit]').text('اضافة');
    fvClass.resetForm(true);
});

    const levelFilter = document.getElementById('levelFilter');
    const cards = Array.from(document.querySelectorAll('.classroom-card'));
    const paginationContainer = document.getElementById('paginationContainer');

    const CARDS_PER_PAGE = 6;
    let currentPage = 1;

    function getFilteredCards() {
        const selectedLevel = levelFilter.value;
        return cards.filter(card => {
        const level = card.dataset.level;
        return !selectedLevel || level === selectedLevel;
        });
    }

    function renderCards() {
        const filtered = getFilteredCards();
        const start = (currentPage - 1) * CARDS_PER_PAGE;
        const end = start + CARDS_PER_PAGE;

        cards.forEach(card => card.style.display = 'none');
        filtered.slice(start, end).forEach(card => card.style.display = '');

        renderPagination(filtered.length);
    }

    function renderPagination(totalCards) {
        const totalPages = Math.max(1, Math.ceil(totalCards / CARDS_PER_PAGE)); // Always at least 1 page
        paginationContainer.innerHTML = '';

        // First button
        paginationContainer.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="prev"><i class="ti ti-chevron-left ti-sm"></i></a>
        </li>
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="first"><i class="ti ti-chevrons-left ti-sm"></i></a>
        </li>
        `;

        for (let i = 1; i <= totalPages; i++) {
        paginationContainer.innerHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
            <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>
        `;
        }

        // Next button
        paginationContainer.innerHTML += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="next"><i class="ti ti-chevron-right ti-sm"></i></a>
        </li>
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="last"><i class="ti ti-chevrons-right ti-sm"></i></a>
        </li>
        `;

        // Events
        paginationContainer.querySelectorAll('a.page-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const action = this.dataset.page;
            const total = Math.max(1, Math.ceil(getFilteredCards().length / CARDS_PER_PAGE));

            switch (action) {
            case 'first':
                currentPage = 1;
                break;
            case 'prev':
                if (currentPage > 1) currentPage--;
                break;
            case 'next':
                if (currentPage < total) currentPage++;
                break;
            case 'last':
                currentPage = total;
                break;
            default:
                currentPage = parseInt(action);
            }

            renderCards();
        });
        });
    }

    levelFilter.addEventListener('change', () => {
        currentPage = 1;
        renderCards();
    });

    renderCards(); // Initial render


const classForm = document.getElementById('classForm');
const fvClass = FormValidation.formValidation(classForm, {
    fields: {
        // classroom fields
        kindergarten_id: {
            validators: {
                callback: {
                    message: 'الرجاء اختيار الروضة',
                    callback: function(input) {
                        return input.value !== '';
                    }
                }
            }
        },
        name: {
            validators: {
                notEmpty: {
                    message: 'اسم الفصل الدراسي مطلوب'
                }
            }
        },
        level: {
            validators: {
                callback: {
                    message: 'الرجاء اختيار المستوى الدراسي',
                    callback: function(input) {
                        return input.value !== '';
                    }
                }
            }
        },
        capacity: {
            validators: {
                notEmpty: {
                    message: 'سعة الفصل الدراسي مطلوبة'
                },
            }
        },
        description: {
            validators: {
                notEmpty: {
                    message: 'سعة الفصل الدراسي مطلوبة'
                },
            }
        },
        image: {
            validators: {
                file: {
                    extension: 'jpg,jpeg,png,gif,webp',
                    type: 'image/jpeg,image/png,image/gif,image/webp',
                    message: 'صيغة الملف غير صحيحة. الرجاء رفع صورة'
                }
            }
        },
        teacher_id: {
            validators: {
                callback: {
                    message: 'الرجاء اختيار معلم الفصل الدراسي',
                    callback: function(input) {
                    const isSelect2Hidden = $('#teacher_id').next('.select2-container').css('display') === 'none';
                    const hasValue = input.value !== '';
                    return isSelect2Hidden || hasValue;
                    }
                }
                }
            },


        // Teacher fields (conditionally required)
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

                        const passwordValue = classForm.querySelector('[name="password"]').value;
                        return input.value.trim().length > 0 && input.value === passwordValue;
                    }
                },
                identical: {
                    compare: function () {
                        return classForm.querySelector('[name="password"]').value;
                    },
                    message: 'كلمات المرور غير متطابقة'
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
            rowSelector: '.col-sm-12, .col-sm-6, .col-sm-4'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()

    }
}).on('core.form.valid', function () {
    classForm.submit();
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
