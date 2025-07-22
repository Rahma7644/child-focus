<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            // classroom fields
            'kindergarten_id' => 'required|exists:kindergartens,id',
            'name' => 'required|string|max:55',
            'description' => 'required|text|max:255',
            'level' => 'required|string',
            'capacity'=> 'required|max:2',
            'image' => 'nullable|image|max:2048',

            // If selecting existing manager
            'teacher_id' => 'nullable|exists:managers,id',

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
            // classrooom Info
            'kindergarten_id.required' => 'الرجاء اختيار الروضة.',

            'name.required' => 'اسم الفصل الدراسي مطلوب.',
            'name.string' => 'اسم الفصل الدراسي يجب أن يكون نصاً.',
            'name.max' => 'اسم الفصل الدراسي يجب ألا يتجاوز 55 حرفاً.',

            'description.required'=> 'وصف الفصل الدراسي مطلوب.',
            'description.text'=> 'وصف الفصل الدراسي يجب ان يكون نصا.',
            'description.max'=> 'وصف الفصل الدراسي يجب ان لا يتجاوز 255 حرف.',

            'capacity.required' => ' سعة الفصل الدراسي مطلوبة.',

            'level.required'=> 'مستوى الفصل الدراسي مطلوب.',

            'image.image' => 'صورة الفصل الدراسي يجب أن يكون صورة.',
            'image.max' => 'حجم صورة الفصل الدراسي يجب ألا يتجاوز 2 ميجابايت.',

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

            'birth_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون قبل تاريخ اليوم.',

            'password.string' => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'password.confirmed' => 'كلمات المرور غير متطابقة.',
        ];
    }
}
