<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePercentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'percent' => 'required|unique:percents,percent,' .$this->route('percent')->id
        ];
    }

    public function messages()
    {
        return [
            'percent.unique' => 'Este porcentaje ya ha sido registrado.'
        ];
    }
}
