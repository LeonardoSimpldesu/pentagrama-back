<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name'=> ['required', 'min:2'],
            'uf'=> ['required', 'min:2'],
            'foundedIn' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome precisa de no mínimo :min caracteres',
            'uf.required' => 'O campo estado é obrigatório',
            'uf.min' => 'O campo estado precisa de no mínimo :min caracteres',
            'foundedIn.required' => 'O campo de Fundado é obrigatório',
        ];
    }
}
