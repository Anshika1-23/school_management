<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeesGroupRequest extends FormRequest
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
            'title' => 'required|unique:fees_groups,title',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required|unique:fees_groups,title,'.$this->id.',id',
            ];
        }
            return $rules;
    }
    public function messages()
    {
        return [
            'title.unique' => 'This Title is already Exists',
        ];
    }
}
