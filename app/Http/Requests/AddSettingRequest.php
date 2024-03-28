<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSettingRequest extends FormRequest
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
        return [
            'config_key' => 'bail|required|unique:settings|max:255',
            'config_value' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'config_key.required' => 'Config key không được phép để trống',
            'config_key.unique' => 'Config key đã tồn tại',
            'config_key.max' => 'Config key không được vượt quá 255 ký tự',
            'config_value.required' => 'Config value không được phép để trống',
        ];
    }
}
