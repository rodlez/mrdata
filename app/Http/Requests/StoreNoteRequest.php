<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'title'         => 'bail|required|min:3|string',
            'info'          => 'bail|required|min:3',
            'tag'           => 'required',
            'category_id'   => 'required',
            'url'           => 'bail|nullable|min:5|string',
            'comment'       => 'bail|nullable|min:5',
            'rating'        => 'nullable|numeric',
            'date'          => 'nullable|date',
            'date_limit'    => 'nullable|date'
        ];
    }
}
