<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentDetailRequest extends FormRequest
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
            'guardian_email' => 'required|unique:parents_details,guardian_email',
            
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'guardian_email' => 'required',Rule::unique('parents_details','guardian_email')->ignore($this->id),
            ];
        }
            return $rules;
        }
        public function messages()
        {
            return [
                'guardian_email.required' => 'This Email is already Exists',
            ];
        }
    }

