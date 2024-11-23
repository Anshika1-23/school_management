<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomeWorkRequest extends FormRequest
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
            'work_date' => 'required',
            'submission_date' => 'required',
            'mark' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'class_id' => 'required',
                'section' => 'required',
                'subject' => 'required',
                'work_date' => 'required',
                'submission_date' => 'required',
                'mark' => 'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
            return [
                'class_id.required' => 'This Class is Required',
                'section.required' => 'This Section is Required',
                'subject.required' => 'This Subject is Required',
                'work_date.required' => 'This HomeWork Date is Required',
                'submission_date.required' => 'This Submission Date is Required',
                'mark.required' => 'This Mark is Required',
            ];
        }
    }

