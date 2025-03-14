<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'name' => 'required|max:255',
            'status' => 'sometimes|integer|between:1,2',
            'keyword' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:5000'
        ];
    }
}
