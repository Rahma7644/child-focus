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

    public function withValidator($validator)
    {
        // Teacher-specific fields
        $validator->sometimes('kindergarten_id', ['required', 'exists:kindergartens,id'], function ($input) {
        return $input->role === 'Teacher';
        });

        $validator->sometimes('specialization', ['required', 'string', 'max:255'], function ($input) {
            return $input->role === 'Teacher';
        });

        // Child-specific fields
        $validator->sometimes('classroom_id', ['required', 'exists:classrooms,id'], function ($input) {
            return $input->role === 'Child';
        });

        $validator->sometimes('address', ['required', 'string', 'max:255'], function ($input) {
            return $input->role === 'Child';
        });

        $validator->sometimes('description', ['nullable', 'string'], function ($input) {
            return $input->role === 'Child';
        });


        $validator->sometimes('parents.0.name', 'required|string|max:100', fn($input) => $input->role === 'Child');
        $validator->sometimes('parents.0.relationship', 'required|string|max:100', fn($input) => $input->role === 'Child');
        $validator->sometimes('parents.0.phone', 'required|digits:9', fn($input) => $input->role === 'Child');
        $validator->sometimes('parents.0.work_address', 'required|string|max:255', fn($input) => $input->role === 'Child');

        // Validate second parent ONLY if any of its fields are filled (optional but must be valid)
        $validator->sometimes('parents.1.name', 'required|string|max:100', fn($input) => isset($input->parents[1]['phone']));
        $validator->sometimes('parents.1.relationship', 'required|string|max:100', fn($input) => isset($input->parents[1]['phone']));
        $validator->sometimes('parents.1.phone', 'required|digits:9', fn($input) => isset($input->parents[1]['phone']));
        $validator->sometimes('parents.1.work_address', 'required|string|max:255', fn($input) => isset($input->parents[1]['phone']));

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
            'password' => 'nullable|string|min:8|confirmed',

            //teacher rules
            'kindergarten_id' => 'nullable|exists:kindergartens,id',
            'specialization' => 'nullable|string|max:55',

            //child rules
            'classroom_id' => 'nullable|exists:classrooms,id',
            'nationality' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            //child parent
            'parents' => 'nullable|array|max:2',
            'parents.*.name' => 'nullable|string|max:100',
            'parents.*.relationship' => 'nullable|string|max:100',
            'parents.*.phone' => 'nullable|digits:9|',
            'parents.*.work_address' => 'nullable|string|max:255',

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

            //teacher
            'kindergarten_id.required' => 'الروضة مطلوبة للمعلم.',
            'kindergarten_id.exists' => 'الروضة المحددة غير موجودة.',

            'specialization.required' => 'التخصص مطلوب للمعلم.',
            'specialization.string' => 'التخصص يجب أن يكون نصاً.',
            'specialization.max' => 'التخصص يجب ألا يتجاوز 255 حرفاً.',

            //child
            'classroom_id.required' => 'الفصل الدراسي مطلوب .',
            'classroom_id.exists' => 'الفصل الدراسي المحدد غير موجود.',

            'nationality.required' => 'الجنسية مطلوبة .',
            'nationality.string' => 'الجنسية يجب أن تكون نصاً.',
            'nationality.max' => 'الجنسية يجب ألا تتجاوز 100 حرف.',

            'address.required' => 'العنوان مطلوب .',
            'address.string' => 'العنوان يجب أن يكون نصاً.',
            'address.max' => 'العنوان يجب ألا يتجاوز 255 حرفاً.',

            'description.string' => 'الوصف يجب أن يكون نصاً.',

            //child parent
            'parents.required' => 'يجب إدخال بيانات ولي أمر واحد على الأقل.',

            'parents.*.name.required_with' => 'اسم ولي الأمر مطلوب عند إدخال رقم الهاتف.',
            'parents.*.name.string' => 'اسم ولي الأمر يجب أن يكون نصاً.',
            'parents.*.name.max' => 'اسم ولي الأمر يجب ألا يتجاوز 100 حرف.',

            'parents.*.relationship.required_with' => 'صلة القرابة مطلوبة.',
            'parents.*.relationship.string' => 'صلة القرابة يجب أن تكون نصاً.',
            'parents.*.relationship.max' => 'صلة القرابة يجب ألا تتجاوز 100 حرف.',

            'parents.*.phone.required_with' => 'رقم الهاتف مطلوب.',
            'parents.*.phone.digits' => 'رقم الهاتف يجب أن يتكون من 9 أرقام.',
            'parents.*.phone.distinct' => 'يجب ألا يتكرر رقم الهاتف بين أولياء الأمور.',
            'parents.*.phone.unique' => 'رقم الهاتف مستخدم بالفعل.',

            'parents.*.workaddress.string' => 'عنوان العمل يجب أن يكون نصاً.',
            'parents.*.workaddress.max' => 'عنوان العمل يجب ألا يتجاوز 255 حرفاً.',

        ];
    }
}
