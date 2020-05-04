<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteCreateRequest extends FormRequest
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
            'url' => 'required|url|unique:favorites|max:255'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'Уже существует закладка с таким :attribute',
            'max' => 'Количество символов в поле :attribute должно быть не больше 255',
            'url' => 'Неверный формат URL'
        ];
    }
}
