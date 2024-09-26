<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
            'name'=>'required|min:3|max:50'
        ];
    }

    public function messages() {
        return [
            'name.required'=>"Non può essere un campo vuoto",
            'name.min'=>"La tipologia non può essere più corta di :min caratteri",
            'name.max'=>"La tipologia non può essere più lunga di :max caratteri"
        ];
    }
}
