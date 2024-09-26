<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
            'name'=>'required|min:3|max:70'
        ];
    }

    public function messages() {
        return [
            'name.required'=>"Non può essere un campo vuoto",
            'name.min'=>"La tecnologia non può essere più corta di :min caratteri",
            'name.max'=>"La tecnologia non può essere più lunga di :max caratteri"
        ];
    }
}
