<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class StoreEngineRequest extends FormRequest
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
        // dd($this->request->all());
        return [
            'name' => ['required', 'min:3', 'max:255', 'unique:engines,name'],
            'hp' => ['gt:10', 'integer', 'nullable'],
            'moment' => ['gt:10', 'integer', 'nullable'],
        ];
    }
}
