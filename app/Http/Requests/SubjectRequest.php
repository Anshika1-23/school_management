<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
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
            'title' => 'required|unique:subjects,title',
            'title_type' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => [
                    'required',
                    Rule::unique('subjects', 'title')->ignore($this->id),
                ],
                'title_type' => 'required',
                'status'=>'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
            return [
                'title.required' => 'This name is already Exists',
                'title_type.required' => 'Subject Type is required',
                'status.required' => 'Subject Status is required',
            ];
        }
    }

