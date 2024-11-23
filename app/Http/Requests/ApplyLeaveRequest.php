<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyLeaveRequest extends FormRequest
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
            //'role' => 'required|unique:apply_leaves,role_id',
            'applyDate' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_type' => 'required',
            'reason' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
               // 'role' => 'required',Rule::unique('apply_leaves','role_id')->ignore($this->id),
               'applyDate' => 'required',
               'from_date' => 'required',
               'to_date' => 'required',
               'leave_type' => 'required',
               'leave_type'=>'required',
                'reason'=>'required',
            ];
        }
            return $rules;
        }
        public function messages()
        {
            return [
            // 'role.required' => 'This name is already Exists',
                'applyDate.required' => 'Apply Date Leave is required',
                'from_date.required' => 'From Date Leave is required',
                'to_date.required' => 'To Date Leave is required',
                'leave_type.required' => 'Leave Type is required',
                'status.required' => 'Apply Leave Reason is required',
            ];
        }
    }
