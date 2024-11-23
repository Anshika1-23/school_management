<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeaveDefineRequest extends FormRequest
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
            'user' => 'required|unique:leave_define,user_id',
            'role' => 'required',
            'leave' => 'required',
            'day' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'user' => 'required',Rule::unique('leave_define','user_id')->ignore($this->id),
                'role' => 'required',
                'leave' => 'required',
                'day' => 'required',
                'status'=>'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
          return [
            'user.required' => 'This name is already Exists',
            'role.required' => 'This Role is required',
            'leave.required' => 'This Leave is required',
            'day.required' => 'This Days is required',
            'status.required' => 'Leave Define Status is required',
          ];
        }
    }
