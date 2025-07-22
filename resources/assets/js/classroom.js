    'use strict';

    $(function () {
    const selectPicker = $('.selectpicker'),
    select2 = $('.select2'),
    flatpickrDisabledRange = document.querySelector('#birth_date');

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

    // reset form
    $('#classModal').on('hidden.bs.modal', function () {
    $('#classForm')[0].reset();
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
                    message: 'وصف الفصل الدراسي مطلوبة'
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
