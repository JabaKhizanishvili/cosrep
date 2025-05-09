<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sendTrainerMessageRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'text' => 'required|max:1000',
        ];
    }
}
