<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRequest extends FormRequest
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
            'title' => 'required|unique:classes,title',
            'section' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $rules = [
                'title' => [
                    'required',
                    // Rule::unique('classes','title')->ignore($this->id),
                ],
                'section'=>'required',
                'status'=>'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
          return [
            'title.required' => 'Class Title is Required',
            'section.required' => 'Class Section is required',
            'status.required' => 'Session Status is required',
          ];
        }
    }

