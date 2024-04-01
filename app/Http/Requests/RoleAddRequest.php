<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|unique:roles|max:255', // Changed 'sliders' to 'roles'
            'description' => 'required',
            'permission_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.unique' => 'Tên đã tồn tại.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'description.required' => 'Mô tả không được để trống.',
            'permission_id.required' => 'ko để trống '
        ];
    }
}
