<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'phone' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255|email',
            'facebook' => 'nullable|min:2|max:255|url',
            'youtube' => 'nullable|min:2|max:255|url',
            'linkedin' => 'nullable|min:2|max:255|url',
            'address' => 'nullable|min:2|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:5000',
            'address' => 'nullable|min:2|max:1000',
        ];
    }
}
