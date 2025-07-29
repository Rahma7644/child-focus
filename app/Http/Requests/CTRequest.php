<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CTRequest extends FormRequest
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
            // If selecting existing teacher
            'teacher_id' => 'nullable|exists:teachers,id',

            // If creating new teacher
            'first_name' => 'nullable|string',
            'second_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'gender' => 'nullable|in:0,1',
            'birth_date' => 'nullable|date',
            'password' => 'nullable|string|confirmed',
            'specialization' => 'nullable|string|max:55',
        ];
    }

    public function messages()
    {
        return [
            // teacher Info
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

            'specialization.string'=> 'التخصص يجب ان يكون نصا',
            'specialization.max'=> 'التخصص يجب ان لا يتجاوز 55 حرفا',

            'birth_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون قبل تاريخ اليوم.',

            'password.string' => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'password.confirmed' => 'كلمات المرور غير متطابقة.',
        ];
    }
}
