<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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
        if (isset($this->object)) {
            return [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email|unique:trainers,email,' . $this->object->id,
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:2048',
                'signature' => 'mimes:jpeg,jpg,png|sometimes|max:2048',
                'facebook' => 'nullable|min:2|max:255|url',
                'twitter' => 'nullable|min:2|max:255|url',
                'linkedin' => 'nullable|min:2|max:255|url',
                'instagram' => 'nullable|min:2|max:255|url',

            ];
        } else {
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:trainers,email|max:255',
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:2048',
                'signature' => 'mimes:jpeg,jpg,png|required|max:2048',
                'facebook' => 'nullable|min:2|max:255|url',
                'twitter' => 'nullable|min:2|max:255|url',
                'linkedin' => 'nullable|min:2|max:255|url',
                'instagram' => 'nullable|min:2|max:255|url',
            ];
        }
    }
}
