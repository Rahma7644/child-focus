<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name' => 'required|string|max:10',
            'second_name' => 'required|string|max:10',
            'last_name' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email,' .$this->id,
            'phone' => 'required|digits:9|unique:users,phone,' .$this->id,
            'gender' => 'required|in:0,1',
            'birth_date' => 'required|date|before:today',
            'password' => 'nullable|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'الاسم الأول مطلوب.',
            'first_name.string' => 'الاسم الأول يجب أن يكون نصاً.',
            'first_name.max' => 'الاسم الأول يجب ألا يتجاوز 10 أحرف.',

            'second_name.required' => 'الاسم الثاني مطلوب.',
            'second_name.string' => 'الاسم الثاني يجب أن يكون نصاً.',
            'second_name.max' => 'الاسم الثاني يجب ألا يتجاوز 10 أحرف.',

            'last_name.required' => 'الاسم الأخير مطلوب.',
            'last_name.string' => 'الاسم الأخير يجب أن يكون نصاً.',
            'last_name.max' => 'الاسم الأخير يجب ألا يتجاوز 10 أحرف.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.digits' => 'رقم الهاتف يجب أن يتكون من 9 أرقام.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',

            'gender.required' => 'الجنس مطلوب.',
            'gender.in' => 'القيمة المختارة للجنس غير صالحة.',

            'birth_date.required' => 'تاريخ الميلاد مطلوب.',
            'birth_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون قبل تاريخ اليوم.',

            'password.string' => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'password.confirmed' => 'كلمات المرور غير متطابقة.',
        ];
    }
}
