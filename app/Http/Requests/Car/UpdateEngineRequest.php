<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEngineRequest extends FormRequest
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
            'name' => [
                'required', 'min:3', 'max:255',
                Rule::unique('engines')->ignore($this->route()->engine->id)
            ],
            'hp' => ['gt:10', 'integer', 'nullable'],
            'moment' => ['gt:10', 'integer', 'nullable'],
        ];
    }
}
