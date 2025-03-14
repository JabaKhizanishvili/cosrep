<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
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
            'email' => 'required|max:255|email|unique:users,email,' . Auth::user()->id,
            'password' => [
                'nullable',
                'min:8',
                'max:16',
                new StrongPassword()
            ],
        ];
    }
}
