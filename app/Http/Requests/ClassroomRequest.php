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
            'description' => 'required|string|max:255',
            'level' => 'required|string',
            'capacity'=> 'required|max:2',
            'image' => 'nullable|image|max:2048',
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
        ];
    }
}
