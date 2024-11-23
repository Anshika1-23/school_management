<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
            'admission_no' => 'required|unique:students,admission_no',
            'roll_no' => Rule::unique('students')->where(function ($query) {
                        return $query->where('class_id', $this->stdClass)
                             ->where('section_id', $this->section);}),
            'academic_year' => 'required',
            //'parent' => 'required',
            'stdClass' => 'required',
            'section' => 'required',
            'std_name' => 'required',
            'l_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'guardian_email' => 'required_if:old_parent_id,==,""',
            'guardian_password' => 'required_if:ol_parent_id,==,""',
            'national_doc'=>'nullable|mimes:pdf',
            'birth_doc'=>'nullable|mimes:pdf',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'admission_no' => 'required',Rule::unique('students','admission_no')->ignore($this->id),
                'roll_no' =>'required',Rule::unique('students')->ignore($this->id)->where(function ($query){
                            return $query->where('class_id', $this->stdClass)
                                 ->where('section_id', $this->section);}),
                'academic_year' => 'required',
              //  'parent' => 'required',
                'stdClass' => 'required',
                'section' => 'required',
                'std_name' => 'required',
                'l_name' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                //'guardian_email' => 'required',
                //'guardian_password' => 'required',
                'national_doc'=>'nullable|mimes:pdf',
                'birth_doc'=>'nullable|mimes:pdf',
                'status'=>'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
          return [
            'admission_no.required' => 'This name is already Exists',
            'parent.required' => 'This Student Parent is required',
            'academic_year.required' => 'This Academic Year is required',
            'stdClass.required' => 'This Class is required',
            'section.required' => 'This Section is required',
            'f_name.required' => 'This First Name is required',
            'l_name.required' => 'This Last Name is required',
            'dob.required' => 'This Date Of Birth is required',
            'gender.required' => 'This Gender is required',
            'status.required' => 'Student Status is required',
          ];
        }
    }

