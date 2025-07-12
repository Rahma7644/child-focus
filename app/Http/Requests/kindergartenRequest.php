<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class kindergartenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Kindergarten fields
            'kgName' => 'required|string|max:30',
            'kgLocation' => 'required|string|max:255',
            'kgPhone' => 'required|digits:9',
            'kgLogo' => 'nullable|image|max:2048',

            // If selecting existing manager
            'manager_id' => 'nullable|exists:managers,id',

            // If creating new manager
            'first_name' => 'nullable|string',
            'second_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'gender' => 'nullable|in:0,1',
            'birth_date' => 'nullable|date',
            'password' => 'nullable|string|confirmed',
        ];
    }

    public function messages()
    {
        return [
            // KG Info
            'kgName.required' => 'اسم الروضة مطلوب.',
            'kgName.string' => 'اسم الروضة يجب أن يكون نصاً.',
            'kgName.max' => 'اسم الروضة يجب ألا يتجاوز 30 حرفاً.',

            'kgLocation.required' => 'موقع الروضة مطلوب.',
            'kgLocation.string' => 'موقع الروضة يجب أن يكون نصاً.',
            'kgLocation.max' => 'موقع الروضة يجب ألا يتجاوز 255 حرفاً.',

            'kgPhone.required' => 'رقم هاتف الروضة مطلوب.',
            'kgPhone.digits' => 'رقم هاتف الروضة يجب أن يتكون من 9 أرقام.',

            'kgLogo.image' => 'شعار الروضة يجب أن يكون صورة.',
            'kgLogo.max' => 'حجم شعار الروضة يجب ألا يتجاوز 2 ميجابايت.',

            // Manager Info
            'first_name.string' => 'الاسم الأول يجب أن يكون نصاً.',
            'first_name.max' => 'الاسم الأول يجب ألا يتجاوز 10 أحرف.',

            'second_name.string' => 'الاسم الثاني يجب أن يكون نصاً.',
            'second_name.max' => 'الاسم الثاني يجب ألا يتجاوز 10 أحرف.',

            'last_name.string' => 'الاسم الأخير يجب أن يكون نصاً.',
            'last_name.max' => 'الاسم الأخير يجب ألا يتجاوز 10 أحرف.',

            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',

            'phone.digits' => 'رقم الهاتف يجب أن يتكون من 9 أرقام.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',

            'gender.in' => 'القيمة المختارة للجنس غير صالحة.',

            'birth_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون قبل تاريخ اليوم.',

            'password.string' => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'password.confirmed' => 'كلمات المرور غير متطابقة.',
        ];
    }
}
