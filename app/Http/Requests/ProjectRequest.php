<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title'=>'required|min:3|max:100',
            'description'=>'required',
            'publication_date'=>'required|date',
            'cover_img'=>'image|mimes:png,jpg,jpeg|max:5120'
        ];
    }

    public function messages() {
        return[
            'title.required'=>"Il titolo è un campo obbligatorio",
            'title.min'=>"Il titolo non può essere più corto di :min caratteri",
            'title.max'=>"Il titolo non può essere più lungo di :max caratteri",
            'description.required'=>"La descrizione è un campo obbligatorio",
            'publication_date.required'=>"La data di uscita è un campo obbligatorio",
            'publication_date.date'=>"Il campo deve essere compilato nel formato sopra descritto",
            'cover_img.image'=>"Il file deve essere di tipo immagine",
            'cover_img.mimes'=>"Il file deve essere di tipo png, jpg, jpeg",
            'cover_img.max'=>"Il file non deve essere più grande di 5mb"
        ];
    }
}
