<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
            'role' => 'required',
            'f_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'img' => 'nullable|mimes:jpg,jpeg,png',
            'resume' => 'nullable|mimes:pdf',
            'join_letter' => 'nullable|mimes:pdf',
            'other_doc' => 'nullable|mimes:pdf',
        ];
        // if (in_array($this->method(), ['PUT', 'PATCH'])) {
        //     $rules = [
        //         'f_name' => 'required',
        //         'status'=>'required',
        //     ];
        // }
            return $rules;
        }
        public function messages()
        {
          return [
        //     'role.required' => 'Role Status is required',
        //     'f_name.required' => 'This First Name is Exists',
        //     'email.required' => 'This First Name is Exists',
          ];
        }
    }
