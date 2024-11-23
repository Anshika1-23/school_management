<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignSubjectTeacherRequest extends FormRequest
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
        $rules = [
            'class_id' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'teacher' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'class_id' => 'required',
                'section'=>'required',
                'subject'=>'required',
                'teacher'=>'required',
                'status'=>'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
            return [
                'class_id.required' => 'This Class Name is already Exists',
                'section.required' => 'Class Section is required',
                'subject.required' => 'Subject Name is required',
                'teacher.required' => 'Teacher Name is required',
                'status.required' => 'Assign Class Teacher Status is required',
            ];
        }
}
