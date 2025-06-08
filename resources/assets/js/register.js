'use strict';

(function () {
    const select2 = $('.select2'),
        selectPicker = $('.selectpicker'),
        flatpickrDisabledRange = document.querySelector('#birth_date');

  // --------------------------------------------------------------------
    const registerValidation = document.querySelector('#register-validation');
    if (registerValidation) {
        // form
        const registerValidationForm = registerValidation.querySelector('#register-form');
        // steps
        const registerValidationFormStep1 = registerValidationForm.querySelector('#kg-info-validation');
        const registerValidationFormStep2 = registerValidationForm.querySelector('#personal-info-validation');
        // next prev button
        const registerValidationNext = [].slice.call(registerValidationForm.querySelectorAll('.btn-next'));
        const registerValidationPrev = [].slice.call(registerValidationForm.querySelectorAll('.btn-prev'));

        const validationStepper = new Stepper(registerValidation, {
        linear: true
        });

        // kg info
        const FormValidation1 = FormValidation.formValidation(registerValidationFormStep1, {
        fields: {
            kgName: {
            validators: {
                notEmpty: {
                message: 'اسم الروضة مطلوب'
                },
                stringLength: {
                min: 6,
                max: 30,
                message: 'اسم الروضة يجب ان يكون بين 6 و 30 حرف'
                },
                regexp: {
                    regexp: /^[\u0600-\u06FFa-zA-Z\s]+$/,
                    message: 'اسم الروضة يجب ان يتكون من الاحرف فقط'
                }
            }
            },
            kgLocation: {
            validators: {
                notEmpty: {
                message: 'موقع الروضة مطلوب'
                },
                uri: {
                    message: 'الرابط غير صالح. الرجاء إدخال رابط صحيح لموقع الروضة'
                }
            }
            },
            kgPhone: {
            validators: {
                notEmpty: {
                message: 'رقم هاتف الروضة مطلوب'
                }
            }
            },
            kgLogo: {
                validators: {
                file: {
                    extension: 'jpg,jpeg,png',
                    type: 'image/jpeg,image/png,image/jpg',
                    message: 'صيغة الصورة غير صالحة. يجب ان تكون صورة بصيغة jpg,jpeg,png'
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
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
            //* Move the error message out of the `input-group` element
            if (e.element.parentElement.classList.contains('input-group')) {
                e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
            });
        }
        }).on('core.form.valid', function () {
        validationStepper.next();
        });

        // Personal info
        const FormValidation2 = FormValidation.formValidation(registerValidationFormStep2, {
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
                notEmpty: {
                message: 'كلمة المرور مطلوبة'
                }
            }
            },
            password_confirmation: {
            validators: {
                notEmpty: {
                message: 'تاكيد كلمة المرور مطلوب'
                },
                identical: {
                compare: function () {
                    return registerValidationFormStep2.querySelector('[name="password"]').value;
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
            rowSelector: '.col-sm-6, .col-sm-4'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        }
        }).on('core.form.valid', function () {
            document.getElementById('register-form').submit();
        });


        registerValidationNext.forEach(item => {
            item.addEventListener('click', event => {
              event.preventDefault(); // <== prevent form from submitting
                switch (validationStepper._currentIndex) {
                    case 0:
                    FormValidation1.validate();
                    break;
                    case 1:
                    FormValidation2.validate();
                    break;

                    default:
                    break;
                }
            });
        });

        registerValidationPrev.forEach(item => {
        item.addEventListener('click', event => {
            switch (validationStepper._currentIndex) {
            case 2:
                validationStepper.previous();
                break;

            case 1:
                validationStepper.previous();
                break;

            case 0:

            default:
                break;
            }
        });
        });

        // Disabled Date Range
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
    }
    })();
